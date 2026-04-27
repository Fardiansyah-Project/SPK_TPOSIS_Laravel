<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class TopsisController extends Controller
{
    private function calculateTopsis()
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $alternatifs = Alternatif::with(['objek', 'penilaians.subKriteria'])->get();

        $matrix = [];
        $divisors = [];
        $normalizedMatrix = [];
        $weightedMatrix = [];
        $idealPositive = [];
        $idealNegative = [];
        $distancePositive = [];
        $distanceNegative = [];
        $preferences = [];

        // 1. Matriks Keputusan
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $penilaian = $alternatif->penilaians->where('kriteria_id', $kriteria->id)->first();
                $nilai = $penilaian && $penilaian->subKriteria ? $penilaian->subKriteria->nilai : 0;
                $matrix[$alternatif->id][$kriteria->id] = $nilai;
            }
        }

        // 2. Pembagi (Divisor)
        foreach ($kriterias as $kriteria) {
            $sumSquares = 0;
            foreach ($alternatifs as $alternatif) {
                $val = $matrix[$alternatif->id][$kriteria->id];
                $sumSquares += pow($val, 2);
            }
            $divisors[$kriteria->id] = sqrt($sumSquares);
        }

        // 3 & 4. Matriks Ternormalisasi dan Ternormalisasi Berbobot
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $val = $matrix[$alternatif->id][$kriteria->id];
                $divisor = $divisors[$kriteria->id] == 0 ? 1 : $divisors[$kriteria->id];
                
                $r = $val / $divisor;
                $v = $r * $kriteria->bobot;
                
                $normalizedMatrix[$alternatif->id][$kriteria->id] = $r;
                $weightedMatrix[$alternatif->id][$kriteria->id] = $v;
            }
        }

        // 5. Solusi Ideal Positif (A+) & Ideal Negatif (A-)
        foreach ($kriterias as $kriteria) {
            $values = array_column($weightedMatrix, $kriteria->id);
            if (count($values) > 0) {
                if ($kriteria->atribut == 'Benefit') {
                    $idealPositive[$kriteria->id] = max($values);
                    $idealNegative[$kriteria->id] = min($values);
                } else { // Cost
                    $idealPositive[$kriteria->id] = min($values);
                    $idealNegative[$kriteria->id] = max($values);
                }
            } else {
                $idealPositive[$kriteria->id] = 0;
                $idealNegative[$kriteria->id] = 0;
            }
        }

        // 6. Jarak Solusi Ideal Positif (D+) & Negatif (D-)
        foreach ($alternatifs as $alternatif) {
            $sumDPos = 0;
            $sumDNeg = 0;
            foreach ($kriterias as $kriteria) {
                $v = $weightedMatrix[$alternatif->id][$kriteria->id] ?? 0;
                $sumDPos += pow($v - ($idealPositive[$kriteria->id] ?? 0), 2);
                $sumDNeg += pow($v - ($idealNegative[$kriteria->id] ?? 0), 2);
            }
            $distancePositive[$alternatif->id] = sqrt($sumDPos);
            $distanceNegative[$alternatif->id] = sqrt($sumDNeg);
        }

        // 7. Nilai Preferensi (V)
        foreach ($alternatifs as $alternatif) {
            $dPos = $distancePositive[$alternatif->id];
            $dNeg = $distanceNegative[$alternatif->id];
            
            $totalDistance = $dPos + $dNeg;
            $score = $totalDistance == 0 ? 0 : $dNeg / $totalDistance;
            
            $preferences[] = [
                'alternatif' => $alternatif,
                'score' => $score
            ];
        }

        // Perangkingan (Sort Descending by score)
        usort($preferences, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return compact(
            'kriterias',
            'alternatifs',
            'matrix',
            'divisors',
            'normalizedMatrix',
            'weightedMatrix',
            'idealPositive',
            'idealNegative',
            'distancePositive',
            'distanceNegative',
            'preferences'
        );
    }

    public function index()
    {
        $data = $this->calculateTopsis();
        return view('topsis.index', $data);
    }

    public function exportPdf()
    {
        $data = $this->calculateTopsis();
        $pdf = Pdf::loadView('topsis.pdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Perhitungan_TOPSIS.pdf');
    }
}
