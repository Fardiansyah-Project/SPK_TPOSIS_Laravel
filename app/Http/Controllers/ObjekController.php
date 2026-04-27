<?php

namespace App\Http\Controllers;

use App\Models\Objek;
use Illuminate\Http\Request;

class ObjekController extends Controller
{
    public function index()
    {
        $objeks = Objek::latest()->get();
        return view('objek.index', compact('objeks'));
    }

    public function create()
    {
        return view('objek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Objek::create($request->all());

        return redirect()->route('objek.index')->with('success', 'Objek berhasil ditambahkan.');
    }

    public function edit(Objek $objek)
    {
        return view('objek.edit', compact('objek'));
    }

    public function update(Request $request, Objek $objek)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $objek->update($request->all());

        return redirect()->route('objek.index')->with('success', 'Objek berhasil diperbarui.');
    }

    public function destroy(Objek $objek)
    {
        $objek->delete();
        return redirect()->route('objek.index')->with('success', 'Objek berhasil dihapus.');
    }
}
