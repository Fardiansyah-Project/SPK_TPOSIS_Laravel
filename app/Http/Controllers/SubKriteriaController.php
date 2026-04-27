<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $subKriterias = SubKriteria::with('kriteria')->orderBy('kriteria_id')->get();
        return view('sub_kriteria.index', compact('subKriterias'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('sub_kriteria.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nilai' => 'required|numeric',
            'kriteria_id' => 'required|exists:kriterias,id',
        ]);

        $kriteria = Kriteria::findOrFail($request->kriteria_id);

        $subkriteria = new SubKriteria();
        $subkriteria->kode = $kriteria->kode . "." . (int)SubKriteria::where('kriteria_id', $request->kriteria_id)->count()+1;
        $subkriteria->nama = $request->nama;
        $subkriteria->nilai = $request->nilai;
        $subkriteria->kriteria_id = $request->kriteria_id;
        $subkriteria->save();

        return redirect()->route('sub-kriteria.index')->with('success', 'Sub Kriteria berhasil ditambahkan.');
    }

    public function edit(SubKriteria $subKriterium)
    {
        // Parameter defaults to subKriterium due to singularization
        $kriterias = Kriteria::all();
        return view('sub_kriteria.edit', compact('subKriterium', 'kriterias'));
    }

    public function update(Request $request, SubKriteria $subKriterium)
    {
        $request->validate([
            'nama' => 'required',
            'nilai' => 'required|numeric',
            'kriteria_id' => 'required|exists:kriterias,id',
        ]);

        $subKriterium->update([
            'nama' => $request->nama,
            'nilai' => $request->nilai,
            'kriteria_id' => $request->kriteria_id,
        ]);

        return redirect()->route('sub-kriteria.index')->with('success', 'Sub Kriteria berhasil diperbarui.');
    }

    public function destroy(SubKriteria $subKriterium)
    {
        $subKriterium->delete();
        return redirect()->route('sub-kriteria.index')->with('success', 'Sub Kriteria berhasil dihapus.');
    }
}
