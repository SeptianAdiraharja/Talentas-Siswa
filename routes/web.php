<?php

use App\Http\Controllers\ProfileController;


use App\Http\Controllers\kepalaSekolah\KepalaSekolahDashboardController;
use App\Http\Controllers\kepalaSekolah\KepalaSekolahRankingController;

// adminController
use App\Http\Controllers\Admin\DashboardController; // Import Dashboard Admin
use App\Http\Controllers\Admin\CriterionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\RankingController;

// guruController
use App\Http\Controllers\Guru\StudentController;
use App\Http\Controllers\Guru\ScoreController;
use App\Http\Controllers\Guru\GuruRankingController;
use App\Http\Controllers\Guru\GuruDashboardController;

// siswaController
use App\Http\Controllers\Siswa\SiswaRankingController;
use App\Http\Controllers\Siswa\NilaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PROFILE (BREEZE)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   Route::middleware(['auth', 'role:kepala sekolah'])
    ->prefix('kepala-sekolah')
    ->name('kepalasekolah.')
    ->group(function () {
        Route::get('/dashboard', [KepalaSekolahDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/ranking', [KepalaSekolahRankingController::class, 'index'])->name('ranking');
        Route::get('/ranking/print/{period_id}', [KepalaSekolahRankingController::class, 'printPdf'])->name('print');

        Route::get('/panduan', function() {
            return view('kepalasekolah.panduan');
        })->name('panduan');
    });

    // ================= tu =================
    Route::middleware('role:tu')->prefix('tu')->group(function () {
        // Kriteria
        Route::resource('criteria', CriterionController::class);
        // User
        Route::resource('users', UserController::class);

        // Periode
        Route::get('/periods', [PeriodController::class, 'index'])->name('admin.periods');
        Route::post('/periods', [PeriodController::class, 'store'])->name('admin.periods.store');
        Route::post('/periods/{id}/activate', [PeriodController::class, 'activate'])->name('admin.periods.activate');

        // Rankings
        Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');
        Route::get('/ranking/export-pdf/{period_id}', [RankingController::class, 'exportPdf'])->name('ranking.pdf');
        Route::get('/ranking/export-excel/{period_id}', [RankingController::class, 'exportExcel'])->name('ranking.excel');

        Route::get('/panduan', function() {
            return view('admin.panduan');
        })->name('admin.panduan');
    });

    // ================= GURU =================
    Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
        // halaman siswa
        Route::get('/siswa', [StudentController::class, 'index'])->name('students');

        // halaman edit nilai siswa
        Route::get('/nilai/{student}/edit', [ScoreController::class, 'edit'])
            ->name('scores.edit');

        // proses edit
        Route::put('/nilai/{student}', [ScoreController::class, 'update'])
            ->name('scores.update');

        Route::get('/ranking', [GuruRankingController::class, 'index'])
            ->name('ranking');

        Route::get('/panduan', function() {
            return view('guru.panduan');
        })->name('panduan');
    });

    // ================= SISWA =================
    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        // ranking
        Route::get('/ranking', [SiswaRankingController::class, 'index'])->name('ranking');

        // nilai
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
    });

});

require __DIR__.'/auth.php';