@extends('layouts.app')
@section('title', 'Edit Sub Kriteria')
@section('header', 'Edit Data Sub Kriteria')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('sub-kriteria.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">&larr; Kembali ke Daftar</a>
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

    <form action="{{ route('sub-kriteria.update', $subKriterium->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="kriteria_id" class="block text-sm font-medium text-gray-700">Kriteria Induk</label>
                <select name="kriteria_id" id="kriteria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                    <option value="">-- Pilih Kriteria --</option>
                    @foreach($kriterias as $k)
                        <option value="{{ $k->id }}" {{ old('kriteria_id', $subKriterium->kriteria_id) == $k->id ? 'selected' : '' }}>
                            {{ $k->kode }} - {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="kode" class="block text-sm font-medium text-gray-700">Kode Sub Kriteria (Otomatis)</label>
                <input type="text" name="kode" id="kode" value="{{ old('kode', $subKriterium->kode) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 bg-gray-100" readonly>
            </div>
            
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama / Rentang Nilai</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $subKriterium->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>

            <div>
                <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai (Angka)</label>
                <input type="number" step="0.01" name="nilai" id="nilai" value="{{ old('nilai', $subKriterium->nilai) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">
                Perbarui Sub Kriteria
            </button>
        </div>
    </form>
</div>
@endsection
