@extends('layouts.app')
@section('title', 'Beri Penilaian')
@section('header', 'Beri Penilaian Alternatif')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-3xl mx-auto">
    <div class="mb-6 border-b pb-4">
        <a href="{{ route('penilaian.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium mb-4 inline-block">&larr; Kembali ke Daftar Penilaian</a>
        <h3 class="text-xl font-bold text-gray-800">Menilai: {{ $alternatif->objek->nama }}</h3>
        <p class="text-gray-500 text-sm">Silakan pilih sub-kriteria yang sesuai untuk setiap kriteria.</p>
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

    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf
        <input type="hidden" name="alternatif_id" value="{{ $alternatif->id }}">
        
        <div class="space-y-6">
            @foreach($kriterias as $kriteria)
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <label class="block text-sm font-bold text-gray-800 mb-2">{{ $kriteria->kode }} - {{ $kriteria->nama }}</label>
                
                @if($kriteria->subKriterias->isEmpty())
                    <p class="text-sm text-red-500">Sub kriteria belum dibuat untuk kriteria ini. Silakan <a href="{{ route('sub-kriteria.create') }}" class="underline">buat dulu</a>.</p>
                @else
                    <select name="nilai[{{ $kriteria->id }}]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 bg-white" required>
                        <option value="">-- Pilih Nilai --</option>
                        @foreach($kriteria->subKriterias as $sub)
                            <option value="{{ $sub->id }}">
                                {{ $sub->nama }} (Nilai/Bobot: {{ $sub->nilai }})
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-8 pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">
                Simpan Penilaian
            </button>
        </div>
    </form>
</div>
@endsection
