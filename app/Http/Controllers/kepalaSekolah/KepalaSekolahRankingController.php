<?php

namespace App\Http\Controllers\kepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class KepalaSekolahRankingController extends Controller
{
    public function index()
    {
        $period = Period::where('is_active', true)->first();

        if (!$period) {
            return redirect()->back()->with('error', 'Tidak ada periode aktif.');
        }

        // Memanggil method kalkulasi internal dari DashboardController
        $dashboardCtrl = new KepalaSekolahDashboardController();
        $rankingData = $dashboardCtrl->calculateRankingInternal($period->id);

        $results = $rankingData['results'];
        $criteria = $rankingData['criteria'];

        return view('kepalasekolah.ranking.index', compact('results', 'period', 'criteria'));
    }

    public function printPdf($period_id)
    {
        $period = Period::findOrFail($period_id);
        $dashboardCtrl = new KepalaSekolahDashboardController();
        $data = $dashboardCtrl->calculateRankingInternal($period_id);

        $fileName = 'Laporan-Ranking-' . Str::slug($period->name) . '.pdf';

        // Menggunakan view PDF yang sudah kita buat sebelumnya untuk TU/Admin
        $pdf = Pdf::loadView('admin.ranking.pdf', [
            'results' => $data['results'],
            'criteria' => $data['criteria'],
            'period' => $period
        ]);

        return $pdf->download($fileName);
    }
}