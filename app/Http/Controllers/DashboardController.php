<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Objek;
use App\Models\Alternatif;

class DashboardController extends Controller
{
    public function index()
    {
        $kriteriaCount = Kriteria::count();
        $subKriteriaCount = SubKriteria::count();
        $objekCount = Objek::count();
        $alternatifCount = Alternatif::count();

        return view('dashboard', compact('kriteriaCount', 'subKriteriaCount', 'objekCount', 'alternatifCount'));
    }
}
