<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Criterion;
use App\Models\Student;
use App\Models\Score;
use App\Exports\RankingExport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class RankingController extends Controller
{

    public function index()
        {
            $period = Period::where('is_active', true)->first();

            if (!$period) {
                return redirect()->back()->with('error', 'Silakan aktifkan satu periode.');
            }

            // Ambil hasil perhitungan (ini sekarang mengembalikan array berisi ['results', 'criteria', 'period'])
            $calculationData = $this->calculateRanking($period->id);

            // Ambil daftar rankingnya saja untuk variabel $results
            $results = $calculationData['results'];

            // Ambil kriteria agar bisa ditampilkan di header tabel jika perlu
            $criteria = $calculationData['criteria'];

            // Pagination tetap diambil untuk link navigasi di bawah tabel
            $students = Student::paginate(10);

            return view('admin.ranking.index', compact('results', 'period', 'students', 'criteria'));
        }

    // Fungsi pembantu agar bisa dipakai berulang kali
    public function calculateRanking($period_id)
    {
        $criteria = Criterion::all();
        $period = Period::findOrFail($period_id);
        $students = Student::with(['user', 'scores' => function ($q) use ($period_id) {
            $q->where('period_id', $period_id);
        }])->get();

        $stats = [];
        foreach ($criteria as $c) {
            $values = Score::where('criteria_id', $c->id)->where('period_id', $period_id)->pluck('value');
            $stats[$c->id] = [
                'max' => $values->max() ?: 1,
                'min' => $values->min() ?: 1,
            ];
        }

        $results = [];
        foreach ($students as $student) {
            $total = 0;
            $normalized_scores = [];

            foreach ($criteria as $c) {
                $score = $student->scores->where('criteria_id', $c->id)->first();
                $val = $score ? $score->value : 0;

                // Hitung Normalisasi
                $normalized = 0;
                if ($val > 0) {
                    $normalized = $c->type === 'benefit'
                        ? $val / $stats[$c->id]['max']
                        : $stats[$c->id]['min'] / $val;
                }

                $normalized_scores[$c->id] = round($normalized, 3);
                $total += $normalized * $c->weight;
            }

            $results[] = [
                'student' => $student,
                'normalized_scores' => $normalized_scores,
                'value' => round($total, 4)
            ];
        }

        usort($results, fn($a, $b) => $b['value'] <=> $a['value']);

        // Kembalikan array berisi semua data yang dibutuhkan
        return [
            'results' => $results,
            'criteria' => $criteria,
            'period'   => $period
        ];
    }

    public function exportPdf($period_id)
    {
        $data = $this->calculateRanking($period_id);

        // Gunakan Str::slug agar nama file aman dari karakter "/"
        $fileName = 'Laporan-Normalisasi-' . Str::slug($data['period']->name) . '.pdf';

        // Kirim seluruh array data ke view
        $pdf = Pdf::loadView('admin.ranking.pdf', $data);

        return $pdf->download($fileName);
    }
    public function exportExcel($period_id)
    {
        $period = Period::findOrFail($period_id);

        // Bersihkan nama file
        $fileName = 'Ranking-Siswa-' . Str::slug($period->name) . '.xlsx';

        return Excel::download(new RankingExport($period_id), $fileName);
    }
}