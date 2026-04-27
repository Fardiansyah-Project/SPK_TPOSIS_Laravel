@extends('layouts.app')
@section('title', 'Edit Objek')
@section('header', 'Edit Data Objek')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('objek.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">&larr; Kembali ke Daftar Objek</a>
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

    <form action="{{ route('objek.update', $objek->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Objek / Penduduk</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $objek->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">
                Perbarui Objek
            </button>
        </div>
    </form>
</div>
@endsection
