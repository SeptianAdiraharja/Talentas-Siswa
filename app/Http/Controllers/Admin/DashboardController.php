<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Criterion;
use App\Models\Score;
use App\Models\Period;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = strtolower($user->role->name);

        if ($role === 'kepala sekolah') {
            return redirect()->route('kepalasekolah.dashboard');
        }

        if ($role === 'tu') {
            $totalSiswa = Student::count();
                    $totalKriteria = Criterion::count();
                    $periodeAktif = Period::where('is_active', true)->first();

                    $persentaseDinilai = 0;
                    if ($periodeAktif && $totalSiswa > 0) {
                        $siswaSudahDinilai = Score::where('period_id', $periodeAktif->id)
                            ->distinct('student_id')
                            ->count('student_id');
                        $persentaseDinilai = round(($siswaSudahDinilai / $totalSiswa) * 100);
                    }

                    $kriteriaLabels = Criterion::pluck('name');
                    $kriteriaData = [];
                    foreach (Criterion::all() as $kriteria) {
                        $avgScore = Score::where('criteria_id', $kriteria->id)
                            ->where('period_id', $periodeAktif->id ?? 0)
                            ->avg('value') ?? 0;
                        $kriteriaData[] = round($avgScore, 2);
                    }

                    return view('admin.dashboard', compact(
                        'totalSiswa', 'totalKriteria', 'persentaseDinilai',
                        'kriteriaLabels', 'kriteriaData', 'periodeAktif'
                    ));
        }

        // 2. Logika untuk GURU
        if ($role === 'guru') {
            $totalSiswa = Student::count();
            $periodeAktif = Period::where('is_active', true)->first();
            $sudahDinilai = Score::where('period_id', $periodeAktif->id ?? 0)
                ->distinct('student_id')
                ->count('student_id');

            return view('guru.dashboard', compact('totalSiswa', 'sudahDinilai', 'periodeAktif'));
        }

        // 3. Logika untuk SISWA
        if ($role === 'siswa') {
            $student = $user->student;
            $periodeAktif = Period::where('is_active', true)->first();

            $hasScores = Score::where('student_id', $student->id ?? 0)
                ->where('period_id', $periodeAktif->id ?? 0)
                ->exists();

            return view('siswa.dashboard', compact('student', 'periodeAktif', 'hasScores'));
        }
    }
}