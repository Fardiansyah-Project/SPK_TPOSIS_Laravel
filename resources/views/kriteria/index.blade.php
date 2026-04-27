@extends('layouts.app')
@section('title', 'Data Kriteria')
@section('header', 'Master Data Kriteria')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Kriteria</h2>
        <a href="{{ route('kriteria.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
            + Tambah Kriteria
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-3 text-sm font-semibold text-gray-600">Kode</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Nama Kriteria</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Atribut</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Bobot</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Keterangan</th>
                    <th class="p-3 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kriterias as $kriteria)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="p-3 text-sm text-gray-800 font-medium">{{ $kriteria->kode }}</td>
                    <td class="p-3 text-sm text-gray-600">{{ $kriteria->nama }}</td>
                    <td class="p-3 text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kriteria->atribut == 'Benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $kriteria->atribut }}
                        </span>
                    </td>
                    <td class="p-3 text-sm text-gray-600">{{ $kriteria->bobot }}</td>
                    <td class="p-3 text-sm text-gray-600">{{ $kriteria->keterangan }}</td>
                    <td class="p-3 text-sm text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">Belum ada data kriteria.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
