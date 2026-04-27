@extends('layouts.app')
@section('title', 'Tambah Kriteria')
@section('header', 'Tambah Kriteria Baru')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('kriteria.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">&larr; Kembali ke Daftar Kriteria</a>
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

    <form action="{{ route('kriteria.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="kode" class="block text-sm font-medium text-gray-700">Kode Kriteria</label>
                <input type="text" name="kode" id="kode" value="{{ old('kode') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required placeholder="Contoh: C1">
            </div>
            
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kriteria</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>

            <div>
                <label for="atribut" class="block text-sm font-medium text-gray-700">Atribut</label>
                <select name="atribut" id="atribut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                    <option value="">-- Pilih Atribut --</option>
                    <option value="Benefit" {{ old('atribut') == 'Benefit' ? 'selected' : '' }}>Benefit (Keuntungan)</option>
                    <option value="Cost" {{ old('atribut') == 'Cost' ? 'selected' : '' }}>Cost (Biaya)</option>
                </select>
            </div>

            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Tingkat Kepentingan</label>
                <select name="keterangan" id="keterangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                    <option value="">-- Pilih Kepentingan --</option>
                    <option value="Sangat Penting" {{ old('keterangan') == 'Sangat Penting' ? 'selected' : '' }}>Sangat Penting</option>
                    <option value="Penting" {{ old('keterangan') == 'Penting' ? 'selected' : '' }}>Penting</option>
                    <option value="Cukup Penting" {{ old('keterangan') == 'Cukup Penting' ? 'selected' : '' }}>Cukup Penting</option>
                    <option value="Kurang Penting" {{ old('keterangan') == 'Kurang Penting' ? 'selected' : '' }}>Kurang Penting</option>
                </select>
            </div>

            <div>
                <label for="bobot" class="block text-sm font-medium text-gray-700">Bobot</label>
                <input type="number" step="0.01" name="bobot" id="bobot" value="{{ old('bobot') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required placeholder="Contoh: 0.25">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">
                Simpan Kriteria
            </button>
        </div>
    </form>
</div>
@endsection
