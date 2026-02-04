<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Criterion;
use App\Models\Student;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class SiswaRankingController extends Controller
{
    public function index()
    {

        $period = Period::where('is_active', true)->firstOrFail();
        $criteria = Criterion::all();

        $students = Student::with(['scores' => function ($q) use ($period) {
            $q->where('period_id', $period->id);
        }])->get();

        // Max / Min tiap kriteria
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
        foreach ($students as $std) {
            $total = 0;
            $matrixNormalisasi = []; // Array untuk menampung nilai normalisasi tiap kriteria

            foreach ($criteria as $c) {
                $score = $std->scores->where('criteria_id', $c->id)->first();
                if (!$score) {
                    $matrixNormalisasi[$c->id] = 0;
                    continue;
                }

                // Rumus Normalisasi
                $normalized = $c->type === 'benefit'
                    ? $score->value / $stats[$c->id]['max']
                    : $stats[$c->id]['min'] / $score->value;

                $matrixNormalisasi[$c->id] = round($normalized, 3); // Simpan hasil per kriteria
                $total += $normalized * $c->weight;
            }

            $results[] = [
                'student' => $std,
                'normalisasi' => $matrixNormalisasi, // Kirim array normalisasi ke view
                'value' => round($total, 4),
            ];
        }

        // Urutkan
        usort($results, fn ($a, $b) => $b['value'] <=> $a['value']);

        $authStudentId = Auth::user()->student->id ?? null;

        return view('siswa.ranking.index', compact(
            'results',
            'period',
            'authStudentId'
        ));
    }
}
