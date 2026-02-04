<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criterion;
use Illuminate\Http\Request;

class CriterionController extends Controller
{
    public function index()
    {
        $criteria = Criterion::all();
        $totalWeight = $criteria->sum('weight');

        return view('admin.criteria.index', compact('criteria', 'totalWeight'));
    }

    public function create()
    {
        return view('admin.criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'type'   => 'required|in:benefit,cost',
            'weight' => 'required|numeric|min:0|max:1',
        ]);

        $currentTotal = Criterion::sum('weight');
        if (($currentTotal + $request->weight) > 1) {
            return back()->withErrors(['weight' => 'Total bobot melebihi 1'])->withInput();
        }

        Criterion::create($request->all());

        return redirect()->route('criteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit(Criterion $criterion)
    {
        return view('admin.criteria.edit', compact('criterion'));
    }

    public function update(Request $request, Criterion $criterion)
    {
        $request->validate([
            'name'   => 'required',
            'type'   => 'required|in:benefit,cost',
            'weight' => 'required|numeric|min:0|max:1',
        ]);

        $otherTotal = Criterion::where('id', '!=', $criterion->id)->sum('weight');
        if (($otherTotal + $request->weight) > 1) {
            return back()->withErrors(['weight' => 'Total bobot melebihi 1'])->withInput();
        }

        $criterion->update($request->all());

        return redirect()->route('criteria.index')
            ->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy(Criterion $criterion)
    {
        $criterion->delete();

        return back()->with('success', 'Kriteria berhasil dihapus');
    }
}
