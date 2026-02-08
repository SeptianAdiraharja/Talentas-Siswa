<?php

namespace App\Http\Controllers\kepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Student;
use App\Models\Criterion;
use App\Models\Score;
use Illuminate\Http\Request;

class KepalaSekolahDashboardController extends Controller
{
    public function index()
{
    // 1. Ambil Periode Aktif
    $period = Period::where('is_active', true)->first();

    if (!$period) {
        return view('kepalasekolah.dashboard', ['error' => 'Tidak ada periode aktif']);
    }

    // 2. Jalankan perhitungan internal
    $rankingData = $this->calculateRankingInternal($period->id);

    // PERBAIKAN: Ambil key 'results' agar data siswa bisa di-collect
    $results = collect($rankingData['results']);

    // 3. Data Statistik untuk Dashboard
    $stats = [
        'total_siswa' => Student::count(),
        'berprestasi_tinggi' => $results->where('value', '>=', 0.8)->count(),
        'rata_rata_nilai' => round($results->avg('value'), 4),
        'top_3' => $results->take(3)
    ];

    // Pastikan variabel $stats, $period, dan $results dikirim
    return view('kepalasekolah.dashboard', compact('period', 'stats', 'results'));
}

    /**
     * Method internal khusus Kepala Sekolah untuk menghitung ranking
     * Berdiri sendiri tanpa bergantung pada Admin Controller
     */
    public function calculateRankingInternal($period_id)
    {
        $criteria = Criterion::all();
        $period = Period::findOrFail($period_id);

        // Ambil siswa beserta nilai pada periode terkait
        $students = Student::with(['user', 'scores' => function ($q) use ($period_id) {
            $q->where('period_id', $period_id);
        }])->get();

        // Cari Max/Min per kriteria untuk normalisasi
        $stats = [];
        foreach ($criteria as $c) {
            $values = Score::where('criteria_id', $c->id)
                ->where('period_id', $period_id)
                ->pluck('value');

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

                // Rumus Normalisasi SAW
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

        // Urutkan berdasarkan nilai preferensi tertinggi
        usort($results, fn($a, $b) => $b['value'] <=> $a['value']);

        return [
            'results' => $results,
            'criteria' => $criteria
        ];
    }
}