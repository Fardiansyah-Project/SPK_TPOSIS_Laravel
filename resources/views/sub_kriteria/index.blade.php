@extends('layouts.app')
@section('title', 'Data Sub Kriteria')
@section('header', 'Master Data Sub Kriteria')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Sub Kriteria</h2>
        <a href="{{ route('sub-kriteria.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
            + Tambah Sub Kriteria
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-3 text-sm font-semibold text-gray-600">Kode</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Kriteria</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Nama / Rentang Nilai</th>
                    <th class="p-3 text-sm font-semibold text-gray-600">Nilai (Bobot Sub)</th>
                    <th class="p-3 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subKriterias as $sub)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="p-3 text-sm text-gray-800 font-medium">{{ $sub->kode }}</td>
                    <td class="p-3 text-sm text-gray-600">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $sub->kriteria->kode ?? '-' }}</span> 
                        {{ $sub->kriteria->nama ?? '-' }}
                    </td>
                    <td class="p-3 text-sm text-gray-600">{{ $sub->nama }}</td>
                    <td class="p-3 text-sm text-gray-800 font-bold">{{ $sub->nilai }}</td>
                    <td class="p-3 text-sm text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('sub-kriteria.edit', $sub->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('sub-kriteria.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada data sub kriteria.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $subKriterias->links() }}
    </div>
</div>
@endsection
