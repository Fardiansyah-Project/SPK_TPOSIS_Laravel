<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Objek;
use App\Models\Alternatif;
use App\Http\Controllers\TopsisController;

class DashboardController extends Controller
{
    public function index()
    {
        $kriteriaCount = Kriteria::count();
        $subKriteriaCount = SubKriteria::count();
        $objekCount = Objek::count();
        $alternatifCount = Alternatif::count();

        // Data Kriteria untuk chart Distribusi Kriteria
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();

        // Data Preferensi TOPSIS untuk chart Hasil Perhitungan
        $topsisData = TopsisController::calculateTopsis();
        $preferences = array_slice($topsisData['preferences'], 0, 6); // Ambil top 6 untuk chart

        return view('dashboard', compact(
            'kriteriaCount', 
            'subKriteriaCount', 
            'objekCount', 
            'alternatifCount',
            'kriterias',
            'preferences'
        ));
    }
}
