<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            abort(403, 'Akun ini tidak terhubung dengan data siswa.');
        }

        $period = Period::where('is_active', true)->firstOrFail();

        $scores = Score::with('criterion')
            ->where('student_id', $student->id)
            ->where('period_id', $period->id)
            ->get();

        return view('siswa.nilai.index', compact(
            'student',
            'period',
            'scores'
        ));
    }
}
