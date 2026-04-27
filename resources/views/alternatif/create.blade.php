@extends('layouts.app')
@section('title', 'Tambah Alternatif')
@section('header', 'Tambah Kandidat Alternatif')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('alternatif.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">&larr; Kembali ke Daftar Alternatif</a>
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

    <form action="{{ route('alternatif.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="objek_id" class="block text-sm font-medium text-gray-700">Pilih Objek / Penduduk</label>
                @if($objeks->isEmpty())
                    <p class="text-sm text-red-500 mt-2">Tidak ada objek tersedia. Semua objek sudah menjadi alternatif atau belum ada objek yang didaftarkan. <a href="{{ route('objek.create') }}" class="underline text-indigo-600">Tambah Objek Dulu</a></p>
                @else
                    <select name="objek_id" id="objek_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                        <option value="">-- Pilih Objek --</option>
                        @foreach($objeks as $obj)
                            <option value="{{ $obj->id }}" {{ old('objek_id') == $obj->id ? 'selected' : '' }}>
                                {{ $obj->nama }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors" {{ $objeks->isEmpty() ? 'disabled' : '' }}>
                Simpan Alternatif
            </button>
        </div>
    </form>
</div>
@endsection
