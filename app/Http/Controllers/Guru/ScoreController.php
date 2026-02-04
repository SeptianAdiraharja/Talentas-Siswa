<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Criterion;
use App\Models\Score;
use App\Models\Period;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function edit(Student $student)
    {
        $period = Period::where('is_active', true)->firstOrFail();
        $criteria = Criterion::oldest()->get();

        // Ambil nilai yang sudah ada
        $scores = Score::where('student_id', $student->id)
            ->where('period_id', $period->id)
            ->get()
            ->keyBy('criteria_id');

        return view('guru.scores.edit', compact(
            'student',
            'criteria',
            'scores',
            'period'
        ));
    }

    public function update(Request $request, Student $student)
    {
        $period = Period::where('is_active', true)->firstOrFail();

        foreach ($request->scores as $criteria_id => $value) {
            Score::updateOrCreate(
                [
                    'student_id'   => $student->id,
                    'criteria_id' => $criteria_id,
                    'period_id'    => $period->id,
                ],
                [
                    'value' => $value
                ]
            );
        }

        return redirect()
            ->route('guru.students')
            ->with('success', 'Nilai berhasil diperbarui');
    }

}
