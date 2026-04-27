@extends('layouts.app')
@section('title', 'Data Penilaian')
@section('header', 'Data Penilaian Alternatif')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Penilaian</h2>
    </div>

    @if($kriterias->isEmpty())
        <div class="bg-yellow-50 text-yellow-700 p-4 rounded-md mb-6">
            Data kriteria masih kosong. <a href="{{ route('kriteria.create') }}" class="underline font-bold">Tambah kriteria dulu</a>.
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-3 text-sm font-semibold text-gray-600">Alternatif (Penduduk)</th>
                    @foreach($kriterias as $k)
                        <th class="p-3 text-sm font-semibold text-gray-600 text-center">{{ $k->kode }}</th>
                    @endforeach
                    <th class="p-3 text-sm font-semibold text-gray-600 text-center">Status</th>
                    <th class="p-3 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alternatifs as $alt)
                @php
                    $isAssessed = $alt->penilaians->count() > 0;
                    $isComplete = $alt->penilaians->count() == $kriterias->count() && $kriterias->count() > 0;
                @endphp
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="p-3 text-sm text-gray-800 font-medium">{{ $alt->objek->nama ?? 'Objek dihapus' }}</td>
                    
                    @foreach($kriterias as $k)
                        @php
                            $penilaianKriteria = $alt->penilaians->where('kriteria_id', $k->id)->first();
                        @endphp
                        <td class="p-3 text-sm text-center">
                            @if($penilaianKriteria)
                                <span class="font-bold text-gray-700" title="{{ $penilaianKriteria->subKriteria->nama ?? '' }}">
                                    {{ $penilaianKriteria->subKriteria->nilai ?? '-' }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    @endforeach

                    <td class="p-3 text-sm text-center">
                        @if($isComplete)
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">Lengkap</span>
                        @elseif($isAssessed)
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold">Belum Lengkap</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-semibold">Belum Dinilai</span>
                        @endif
                    </td>
                    <td class="p-3 text-sm text-center">
                        <div class="flex justify-center space-x-2">
                            @if($isAssessed)
                                <a href="{{ route('penilaian.edit', $alt->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded">Edit Nilai</a>
                            @else
                                <a href="{{ route('penilaian.create', ['alternatif' => $alt->id]) }}" class="text-green-600 hover:text-green-900 bg-green-50 px-3 py-1 rounded">Beri Nilai</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ 3 + $kriterias->count() }}" class="p-6 text-center text-gray-500">Belum ada alternatif yang bisa dinilai.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
