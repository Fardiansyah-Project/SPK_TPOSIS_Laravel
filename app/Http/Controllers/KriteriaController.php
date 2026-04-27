<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kriterias,kode',
            'nama' => 'required',
            'bobot' => 'required|numeric',
            'atribut' => 'required|in:Benefit,Cost',
            'keterangan' => 'required|in:Sangat Penting,Penting,Cukup Penting,Kurang Penting',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriterium)
    {
        // Parameter Laravel default uses singular of model name, so $kriterium is passed
        return view('kriteria.edit', compact('kriterium'));
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        $request->validate([
            'kode' => 'required|unique:kriterias,kode,'.$kriterium->id,
            'nama' => 'required',
            'bobot' => 'required|numeric',
            'atribut' => 'required|in:Benefit,Cost',
            'keterangan' => 'required|in:Sangat Penting,Penting,Cukup Penting,Kurang Penting',
        ]);

        $kriterium->update($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
