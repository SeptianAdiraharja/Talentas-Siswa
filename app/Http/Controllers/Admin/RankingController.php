<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Period;
use App\Models\Criterion;
use App\Models\Student;
use App\Models\Score;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
       // Gunakan first() agar tidak langsung melempar 404 jika kosong
        $period = Period::where('is_active', true)->first();

        // Berikan validasi agar user tahu masalahnya
        if (!$period) {
            return redirect()->route('admin.periods')
                ->with('error', 'Silakan aktifkan satu periode terlebih dahulu untuk melihat ranking.');
        }

        $criteria = Criterion::all();

        $students = Student::with(['scores' => function ($q) use ($period) {
            $q->where('period_id', $period->id);
        }])->paginate(10);

        // Cari max/min per kriteria
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

        $results = [];

        foreach ($students as $student) {
            $total = 0;

            foreach ($criteria as $c) {
                $score = $student->scores
                    ->where('criteria_id', $c->id)
                    ->first();

                if (!$score) continue;

                $normalized = $c->type === 'benefit'
                    ? $score->value / $stats[$c->id]['max']
                    : $stats[$c->id]['min'] / $score->value;

                $total += $normalized * $c->weight;
            }

            $results[] = [
                'student' => $student,
                'value'   => round($total, 4)
            ];
        }

        // Urutkan ranking
        usort($results, fn($a, $b) => $b['value'] <=> $a['value']);

        return view('admin.ranking.index', compact('results', 'period', 'students'));
    }
}
