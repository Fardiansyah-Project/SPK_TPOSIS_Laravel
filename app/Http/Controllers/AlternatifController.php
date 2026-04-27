<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Objek;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::with('objek')->latest()->get();
        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        $objeks = Objek::doesntHave('alternatifs')->get(); // Hanya objek yg belum jadi alternatif
        return view('alternatif.create', compact('objeks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'objek_id' => 'required|exists:objeks,id|unique:alternatifs,objek_id',
        ]);

        Alternatif::create($request->all());

        return redirect()->route('alternatif.index')->with('success', 'Kandidat Alternatif berhasil ditambahkan.');
    }

    public function edit(Alternatif $alternatif)
    {
        $objeks = Objek::all();
        return view('alternatif.edit', compact('alternatif', 'objeks'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'objek_id' => 'required|exists:objeks,id|unique:alternatifs,objek_id,'.$alternatif->id,
        ]);

        $alternatif->update($request->all());

        return redirect()->route('alternatif.index')->with('success', 'Kandidat Alternatif berhasil diperbarui.');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('alternatif.index')->with('success', 'Kandidat Alternatif berhasil dihapus.');
    }
}
