<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::orderByDesc('id')->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Period::create([
            'name' => $request->name,
            'is_active' => false
        ]);

        return back()->with('success', 'Periode berhasil ditambahkan');
    }

    public function activate($id)
    {
        Period::where('is_active', true)->update(['is_active' => false]);
        Period::where('id', $id)->update(['is_active' => true]);

        return back()->with('success', 'Periode diaktifkan');
    }
}
