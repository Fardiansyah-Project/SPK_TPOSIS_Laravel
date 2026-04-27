@extends('layouts.app')
@section('title', 'Edit Penilaian')
@section('header', 'Edit Penilaian Alternatif')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-3xl mx-auto">
    <div class="mb-6 border-b pb-4">
        <a href="{{ route('penilaian.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium mb-4 inline-block">&larr; Kembali ke Daftar Penilaian</a>
        <h3 class="text-xl font-bold text-gray-800">Edit Penilaian: {{ $alternatif->objek->nama }}</h3>
        <p class="text-gray-500 text-sm">Perbarui pilihan sub-kriteria untuk alternatif ini.</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-md mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.update', $alternatif->id) }}" method="POST" id="form-update">
        @csrf
        @method('PUT')
        <input type="hidden" name="alternatif_id" value="{{ $alternatif->id }}">
        
        <div class="space-y-6">
            @foreach($kriterias as $kriteria)
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <label class="block text-sm font-bold text-gray-800 mb-2">{{ $kriteria->kode }} - {{ $kriteria->nama }}</label>
                
                @if($kriteria->subKriterias->isEmpty())
                    <p class="text-sm text-red-500">Sub kriteria belum dibuat.</p>
                @else
                    <select name="nilai[{{ $kriteria->id }}]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 bg-white" required>
                        <option value="">-- Pilih Nilai --</option>
                        @foreach($kriteria->subKriterias as $sub)
                            @php
                                $selected = isset($penilaian_data[$kriteria->id]) && $penilaian_data[$kriteria->id] == $sub->id ? 'selected' : '';
                            @endphp
                            <option value="{{ $sub->id }}" {{ $selected }}>
                                {{ $sub->nama }} (Nilai/Bobot: {{ $sub->nilai }})
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
            @endforeach
        </div>
    </form>

    <div class="mt-8 pt-4 border-t border-gray-100 flex justify-between items-center">
        <form action="{{ route('penilaian.destroy', $alternatif->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus semua penilaian orang ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus Semua Nilai</button>
        </form>
        
        <button type="submit" form="form-update" class="bg-indigo-600 text-white px-6 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">
            Perbarui Penilaian
        </button>
    </div>
</div>
@endsection
