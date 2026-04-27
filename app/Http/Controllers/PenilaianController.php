<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::with(['objek', 'penilaians'])->get();
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        return view('penilaian.index', compact('alternatifs', 'kriterias'));
    }

    public function create(Request $request)
    {
        $alternatif_id = $request->get('alternatif');
        if (!$alternatif_id) {
            return redirect()->route('penilaian.index')->with('error', 'Pilih alternatif terlebih dahulu untuk dinilai.');
        }

        $alternatif = Alternatif::with('objek')->findOrFail($alternatif_id);
        $kriterias = Kriteria::with('subKriterias')->orderBy('kode', 'asc')->get();
        
        return view('penilaian.create', compact('alternatif', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatifs,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|exists:sub_kriterias,id',
        ]);

        $alternatif_id = $request->alternatif_id;

        // Hapus penilaian lama jika ada
        Penilaian::where('alternatif_id', $alternatif_id)->delete();

        // Simpan penilaian baru
        foreach ($request->nilai as $kriteria_id => $sub_kriteria_id) {
            Penilaian::create([
                'alternatif_id' => $alternatif_id,
                'kriteria_id' => $kriteria_id,
                'sub_kriteria_id' => $sub_kriteria_id,
            ]);
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function edit($id)
    {
        // Dalam resource, $id biasanya penilaian_id. Kita akali dengan mengirim id alternatif.
        // Karena kita mau edit semua kriteria untuk 1 alternatif sekaligus.
        $alternatif = Alternatif::with(['objek', 'penilaians'])->findOrFail($id);
        $kriterias = Kriteria::with('subKriterias')->orderBy('kode', 'asc')->get();

        // Siapkan array penilaian_id untuk pre-select dropdown
        $penilaian_data = [];
        foreach ($alternatif->penilaians as $p) {
            $penilaian_data[$p->kriteria_id] = $p->sub_kriteria_id;
        }

        return view('penilaian.edit', compact('alternatif', 'kriterias', 'penilaian_data'));
    }

    public function update(Request $request, $id)
    {
        // Update logic is same as store (delete old, create new)
        $request->validate([
            'alternatif_id' => 'required|exists:alternatifs,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|exists:sub_kriterias,id',
        ]);

        $alternatif_id = $request->alternatif_id;

        // Hapus penilaian lama
        Penilaian::where('alternatif_id', $alternatif_id)->delete();

        // Simpan penilaian baru
        foreach ($request->nilai as $kriteria_id => $sub_kriteria_id) {
            Penilaian::create([
                'alternatif_id' => $alternatif_id,
                'kriteria_id' => $kriteria_id,
                'sub_kriteria_id' => $sub_kriteria_id,
            ]);
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus semua penilaian untuk alternatif tersebut
        Penilaian::where('alternatif_id', $id)->delete();
        return redirect()->route('penilaian.index')->with('success', 'Semua penilaian untuk alternatif ini berhasil dihapus.');
    }
}
