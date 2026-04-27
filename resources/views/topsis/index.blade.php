@extends('layouts.app')

@section('title', 'Hasil TOPSIS')
@section('header', 'Hasil Perhitungan Metode TOPSIS')

@section('content')
<style>
    .table-card { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); overflow-x: auto; }
    .table-header { font-weight: 600; color: #1e293b; background-color: #f1f5f9; padding: 0.75rem 1rem; border-bottom: 2px solid #e2e8f0; text-align: left; white-space: nowrap; }
    .table-cell { padding: 0.75rem 1rem; border-bottom: 1px solid #f1f5f9; color: #475569; white-space: nowrap; }
    .table-row:hover { background-color: #f8fafc; transition: background-color 0.2s ease; }
    .section-title { font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; }
    .section-title::before { content: ''; display: inline-block; width: 4px; height: 1.25rem; background-color: #4f46e5; margin-right: 0.5rem; border-radius: 2px; }
</style>

<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <h1 class="text-xl font-semibold text-gray-600">Sistem Penentuan Penerima BPNT</h1>
    
    @if(!$kriterias->isEmpty() && !$alternatifs->isEmpty())
    <a href="{{ route('topsis.pdf') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors inline-flex items-center shadow-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Unduh Laporan PDF
    </a>
    @endif
</div>

@if($kriterias->isEmpty() || $alternatifs->isEmpty())
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">Data kriteria atau alternatif masih kosong. Silakan isi data terlebih dahulu di menu Data Master.</p>
            </div>
        </div>
    </div>
@else

<!-- 1. Data Kriteria -->
<div class="table-card">
    <h2 class="section-title">1. Data Kriteria</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="table-header">Kode</th>
                <th class="table-header">Kriteria</th>
                <th class="table-header">Atribut</th>
                <th class="table-header text-center">Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriterias as $k)
            <tr class="table-row">
                <td class="table-cell font-medium">{{ $k->kode }}</td>
                <td class="table-cell">{{ $k->nama }}</td>
                <td class="table-cell">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $k->atribut == 'Benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $k->atribut ?? '-' }}
                    </span>
                </td>
                <td class="table-cell text-center">{{ number_format($k->bobot, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- 2. Matriks Keputusan -->
<div class="table-card">
    <h2 class="section-title">2. Matriks Keputusan (X)</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="table-header">Alternatif</th>
                @foreach($kriterias as $k)
                    <th class="table-header text-center">{{ $k->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- Pembagi -->
            <tr class="bg-gray-50 font-semibold border-b-2 border-gray-200">
                <td class="table-cell italic">Pembagi (Divisor)</td>
                @foreach($kriterias as $k)
                    <td class="table-cell text-center">{{ number_format($divisors[$k->id], 4) }}</td>
                @endforeach
            </tr>
            <!-- Nilai X -->
            @foreach($alternatifs as $alt)
            <tr class="table-row">
                <td class="table-cell font-medium">{{ $alt->objek->nama ?? 'Alternatif '.$alt->id }}</td>
                @foreach($kriterias as $k)
                    <td class="table-cell text-center">{{ $matrix[$alt->id][$k->id] ?? 0 }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- 3. Matriks Ternormalisasi -->
<div class="table-card">
    <h2 class="section-title">3. Matriks Ternormalisasi (R)</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="table-header">Alternatif</th>
                @foreach($kriterias as $k)
                    <th class="table-header text-center">{{ $k->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $alt)
            <tr class="table-row">
                <td class="table-cell font-medium">{{ $alt->objek->nama ?? 'Alternatif '.$alt->id }}</td>
                @foreach($kriterias as $k)
                    <td class="table-cell text-center">{{ number_format($normalizedMatrix[$alt->id][$k->id] ?? 0, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- 4. Matriks Ternormalisasi Berbobot -->
<div class="table-card">
    <h2 class="section-title">4. Matriks Ternormalisasi Berbobot (Y)</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="table-header">Alternatif</th>
                @foreach($kriterias as $k)
                    <th class="table-header text-center">{{ $k->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $alt)
            <tr class="table-row">
                <td class="table-cell font-medium">{{ $alt->objek->nama ?? 'Alternatif '.$alt->id }}</td>
                @foreach($kriterias as $k)
                    <td class="table-cell text-center">{{ number_format($weightedMatrix[$alt->id][$k->id] ?? 0, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- 5. Solusi Ideal Positif & Negatif -->
<div class="table-card">
    <h2 class="section-title">5. Solusi Ideal Positif (A+) dan Negatif (A-)</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="table-header">Solusi Ideal</th>
                @foreach($kriterias as $k)
                    <th class="table-header text-center">{{ $k->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr class="table-row">
                <td class="table-cell font-medium text-indigo-600">Positif (A+)</td>
                @foreach($kriterias as $k)
                    <td class="table-cell text-center">{{ number_format($idealPositive[$k->id] ?? 0, 4) }}</td>
                @endforeach
            </tr>
            <tr class="table-row">
                <td class="table-cell font-medium text-rose-600">Negatif (A-)</td>
                @foreach($kriterias as $k)
                    <td class="table-cell text-center">{{ number_format($idealNegative[$k->id] ?? 0, 4) }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

<!-- 6. Jarak Solusi Ideal -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="table-card">
        <h2 class="section-title">6a. Jarak Positif (D+)</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="table-header">Alternatif</th>
                    <th class="table-header text-right">Nilai D+</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $alt)
                <tr class="table-row">
                    <td class="table-cell">{{ $alt->objek->nama ?? 'Alternatif '.$alt->id }}</td>
                    <td class="table-cell text-right font-medium">{{ number_format($distancePositive[$alt->id] ?? 0, 4) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="table-card">
        <h2 class="section-title">6b. Jarak Negatif (D-)</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="table-header">Alternatif</th>
                    <th class="table-header text-right">Nilai D-</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $alt)
                <tr class="table-row">
                    <td class="table-cell">{{ $alt->objek->nama ?? 'Alternatif '.$alt->id }}</td>
                    <td class="table-cell text-right font-medium">{{ number_format($distanceNegative[$alt->id] ?? 0, 4) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- 7. Hasil Akhir dan Perangkingan -->
<div class="table-card bg-indigo-50/30 border border-indigo-100">
    <h2 class="section-title text-indigo-800">7. Hasil Akhir (Preferensi) dan Perangkingan</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="table-header bg-indigo-100 text-indigo-900 rounded-tl-lg">Ranking</th>
                <th class="table-header bg-indigo-100 text-indigo-900">Alternatif</th>
                <th class="table-header bg-indigo-100 text-indigo-900 text-right rounded-tr-lg">Nilai Preferensi (V)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($preferences as $index => $pref)
            <tr class="table-row border-b border-indigo-50 {{ $index == 0 ? 'bg-yellow-50' : '' }}">
                <td class="table-cell font-bold {{ $index == 0 ? 'text-yellow-600 text-lg' : 'text-gray-600' }}">
                    {{ $index + 1 }}
                    @if($index == 0) <span class="ml-2 text-sm text-yellow-500">🏆 Terbaik</span> @endif
                </td>
                <td class="table-cell font-medium {{ $index == 0 ? 'text-gray-900' : '' }}">
                    {{ $pref['alternatif']->objek->nama ?? 'Alternatif '.$pref['alternatif']->id }}
                </td>
                <td class="table-cell text-right font-bold {{ $index == 0 ? 'text-indigo-600' : 'text-gray-700' }}">
                    {{ number_format($pref['score'], 4) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
