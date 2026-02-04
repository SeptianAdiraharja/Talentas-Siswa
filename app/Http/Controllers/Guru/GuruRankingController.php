<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Criterion;
use App\Models\Student;
use App\Models\Score;

class GuruRankingController extends Controller
{
    public function index()
    {
        // Ambil periode aktif
        $period = Period::where('is_active', true)->firstOrFail();
        $criteria = Criterion::all();

        // Ambil siswa + nilai periode aktif
        $students = Student::with(['scores' => function ($q) use ($period) {
            $q->where('period_id', $period->id);
        }])->paginate(10);

        // Hitung max/min per kriteria
        $stats = [];
        foreach ($criteria as $c) {
            $values = Score::where('criteria_id', $c->id)
                ->where('period_id', $period->id)
                ->pluck('value');

            $stats[$c->id] = [
                'max' => $values->max(),
                'min' => $values->min(),
            ];
        }

        // Proses SAW
        $results = [];
        foreach ($students as $student) {
            $total = 0;
            $normalisasiSiswa = []; // Array penampung nilai normalisasi

            foreach ($criteria as $c) {
                $score = $student->scores->where('criteria_id', $c->id)->first();

                if ($score && isset($stats[$c->id])) {
                    $normalized = $c->type === 'benefit'
                        ? $score->value / $stats[$c->id]['max']
                        : $stats[$c->id]['min'] / $score->value;

                    $normalisasiSiswa[$c->id] = round($normalized, 3);
                    $total += $normalized * $c->weight;
                } else {
                    $normalisasiSiswa[$c->id] = 0;
                }
            }

            $results[] = [
                'student' => $student,
                'matrix' => $normalisasiSiswa, // Simpan matriks di sini
                'value' => round($total, 4),
            ];
        }

        usort($results, fn($a, $b) => $b['value'] <=> $a['value']);

        return view('guru.ranking.index', compact(
            'results',
            'period',
            'criteria',
            'students'
            ));
    }
}
