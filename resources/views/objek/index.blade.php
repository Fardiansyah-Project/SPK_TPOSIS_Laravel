@extends('layouts.app')
@section('title', 'Data Objek / Penduduk')
@section('header', 'Master Data Objek / Penduduk')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Objek (Penduduk)</h2>
        <a href="{{ route('objek.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
            + Tambah Objek
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-3 text-sm font-semibold text-gray-600 w-16">No</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Nama Objek / Penduduk</th>
                    <th class="p-3 text-sm font-semibold text-gray-600 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objeks as $index => $objek)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="p-3 text-sm text-gray-600">{{ $index + 1 }}</td>
                    <td class="p-3 text-sm text-gray-800 font-medium">{{ $objek->nama }}</td>
                    <td class="p-3 text-sm text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('objek.edit', $objek->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('objek.destroy', $objek->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus objek ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-500">Belum ada data objek.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
