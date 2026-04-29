@extends('layouts.app')

@section('title', 'Dashboard')

<!-- We hide the app.blade.php's header by defining an empty header section and moving styling to content -->
@section('header')
@endsection

@section('content')
    <div class="-m-6 p-8 bg-slate-50 min-h-[calc(100vh-4rem)] font-sans">

        <!-- Top bar inside content -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <div class="text-sm text-slate-400 font-medium mb-1">Overview</div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative group">
                    <input type="text" placeholder="Cari sesuatu..."
                        class="pl-10 pr-4 py-2.5 rounded-2xl border border-slate-200 focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 bg-white text-sm w-72 transition-all duration-300 outline-none shadow-sm group-hover:shadow">
                    <svg class="w-5 h-5 absolute left-3.5 top-2.5 text-slate-400 group-hover:text-indigo-500 transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button
                    class="text-slate-500 hover:text-indigo-600 bg-white p-2.5 border border-slate-200 rounded-2xl shadow-sm hover:shadow transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- 4 Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Kriteria -->
            <div
                class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex justify-between items-center group">
                <div>
                    <div class="text-sm font-medium text-slate-500 mb-1">Total Kriteria</div>
                    <div class="text-3xl font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                        {{ $kriteriaCount ?? 0 }}</div>
                </div>
                <div
                    class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </div>
            </div>
            <!-- Sub Kriteria -->
            <div
                class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex justify-between items-center group">
                <div>
                    <div class="text-sm font-medium text-slate-500 mb-1">Sub Kriteria</div>
                    <div class="text-3xl font-extrabold text-slate-800 group-hover:text-indigo-600 transition-colors">
                        {{ $subKriteriaCount ?? 0 }}</div>
                </div>
                <div
                    class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
            </div>
            <!-- Objek -->
            <div
                class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex justify-between items-center group">
                <div>
                    <div class="text-sm font-medium text-slate-500 mb-1">Total Objek</div>
                    <div class="text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors">
                        {{ $objekCount ?? 0 }}</div>
                </div>
                <div
                    class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <!-- Alternatif -->
            <div
                class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex justify-between items-center group">
                <div>
                    <div class="text-sm font-medium text-slate-500 mb-1">Kandidat</div>
                    <div class="text-3xl font-extrabold text-slate-800 group-hover:text-amber-600 transition-colors">
                        {{ $alternatifCount ?? 0 }}</div>
                </div>
                <div
                    class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Middle Section -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
            <!-- Sistem Pendukung Keputusan -->
            <div
                class="lg:col-span-3 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col md:flex-row gap-6 items-center">
                <div class="w-full md:w-3/5 flex flex-col justify-center">
                    <div
                        class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-xs font-bold tracking-wide uppercase mb-4 w-max">
                        Sistem Keputusan
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-800 mb-4 leading-tight">Penerima Bantuan Pangan <br /> Non
                        Tunai <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-rose-400">(BPNT)</span>
                    </h2>
                    <p class="text-slate-500 leading-relaxed mb-8">
                        Sistem ini dirancang untuk mempermudah dan meningkatkan akurasi dalam proses penyeleksian penerima
                        Bantuan Pangan Non Tunai (BPNT). Melalui perhitungan terkomputerisasi, setiap calon penerima
                        dievaluasi secara adil berdasarkan kriteria-kriteria kelayakan agar bantuan sosial tersalurkan tepat
                        sasaran kepada masyarakat yang paling membutuhkan.
                    </p>
                    <div>
                        <a href="{{ route('topsis.index') }}"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm hover:shadow-indigo-500/30 transition-all duration-300">
                            Mulai Perhitungan <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div
                    class="w-full md:w-2/5 h-full min-h-[200px] bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl flex items-center justify-center p-6 border border-indigo-100/50">
                    <img src="{{ asset('images/spk_logo.png') }}" alt="SPK Logo"
                        class="max-w-full max-h-full object-contain drop-shadow-xl hover:scale-105 transition-transform duration-500">
                </div>
            </div>

            <!-- Kegunaan TOPSIS -->
            <div
                class="lg:col-span-2 bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 shadow-md flex flex-col justify-between text-white relative overflow-hidden group">
                <!-- Background decoration -->
                <div
                    class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500 rounded-full blur-3xl opacity-20 group-hover:opacity-30 transition-opacity duration-500">
                </div>
                <div
                    class="absolute -bottom-10 -left-10 w-40 h-40 bg-rose-500 rounded-full blur-3xl opacity-20 group-hover:opacity-30 transition-opacity duration-500">
                </div>

                <div class="relative z-10">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center mr-4 backdrop-blur-sm border border-white/10">
                            <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold">Kegunaan TOPSIS</h2>
                    </div>
                    <ul class="text-sm space-y-4 text-slate-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-400 mr-3 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>Konsepnya yang sederhana dan mudah dipahami.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-400 mr-3 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>Komputasinya efisien dan akurat.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-400 mr-3 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="leading-relaxed">Mampu mengukur kinerja relatif alternatif keputusan secara
                                sederhana, membuat pengambilan keputusan jauh lebih cepat.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kriteria Chart Card -->
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm group">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Distribusi Kriteria</h3>
                        <p class="text-sm text-slate-500 mt-1">Bobot kriteria dalam perhitungan</p>
                    </div>
                    <button
                        class="w-8 h-8 rounded-full bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                            </path>
                        </svg>
                    </button>
                </div>

                <div
                    class="bg-slate-900 rounded-2xl h-56 w-full relative overflow-hidden group-hover:shadow-lg transition-shadow duration-500">
                    <!-- Decorative Background -->
                    <div
                        class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50">
                    </div>
                    <div
                        class="absolute left-6 top-6 bottom-8 flex flex-col justify-between text-xs text-slate-400 font-medium z-10">
                        <span>1.0</span>
                        <span>0.5</span>
                        <span>0</span>
                    </div>
                    <!-- Bars -->
                    <div
                        class="absolute left-16 right-6 bottom-8 h-[calc(100%-3.5rem)] flex items-end justify-around z-10 space-x-2">
                        @foreach ($kriterias as $kriteria)
                            @php
                                $heightPercentage = min(100, max(5, ($kriteria->bobot / 1) * 100)); // max weight assumed 1.0 based on constraint
                            @endphp
                            <div class="relative w-full max-w-[32px] h-full flex items-end group/bar">
                                <div class="w-full bg-gradient-to-t from-indigo-500/40 via-indigo-500/80 to-indigo-400 rounded-t-sm hover:from-indigo-400 hover:via-indigo-400 hover:to-indigo-300 transition-colors cursor-pointer relative shadow-sm"
                                    style="height: {{ $heightPercentage }}%">
                                    <div
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-slate-900 text-[10px] py-1 px-1.5 rounded opacity-0 group-hover/bar:opacity-100 transition-opacity font-bold whitespace-nowrap shadow-md z-20">
                                        {{ $kriteria->bobot }}
                                    </div>
                                    <div
                                        class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-slate-400 text-xs font-semibold truncate w-full text-center">
                                        {{ $kriteria->kode }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Hasil Perhitungan Chart Card -->
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm group">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Hasil Perhitungan</h3>
                        <div class="flex text-xs font-semibold mt-2 space-x-3 items-center">
                            <span class="flex items-center text-slate-500"><span
                                    class="w-2 h-2 rounded-full bg-indigo-500 mr-1.5"></span> Nilai Preferensi</span>
                        </div>
                    </div>
                </div>

                <!-- Modern Bar Chart Placeholder -->
                <div class="relative h-56 w-full">
                    <!-- Grid Lines -->
                    <div class="absolute left-8 right-0 top-0 bottom-6 flex flex-col justify-between">
                        <div class="w-full border-t border-slate-100 border-dashed"></div>
                        <div class="w-full border-t border-slate-100 border-dashed"></div>
                        <div class="w-full border-t border-slate-100 border-dashed"></div>
                        <div class="w-full border-t border-slate-100 border-dashed"></div>
                        <div class="w-full border-t border-slate-200"></div>
                    </div>

                    <div
                        class="absolute left-0 top-0 bottom-6 flex flex-col justify-between text-xs text-slate-400 font-medium w-6 py-1">
                        <span>1.0</span>
                        <span>0.8</span>
                        <span>0.6</span>
                        <span>0.4</span>
                        <span>0.2</span>
                        <span>0</span>
                    </div>

                    <!-- Bars -->
                    <div
                        class="absolute left-12 right-4 bottom-6 h-[calc(100%-1.5rem)] flex items-end justify-between px-2 pb-[1px] z-10">
                        @if (!empty($preferences) && count($preferences) > 0)
                            @foreach ($preferences as $index => $pref)
                                @php
                                    $score = $pref['score'];
                                    $height = min(100, max(2, $score * 100)); // Minimum 2% height so it's visible
                                    $isTop = $index === 0;
                                @endphp
                                <div class="relative w-[12%] flex flex-col justify-end items-center h-full group/bar">
                                    <div class="w-full bg-gradient-to-t {{ $isTop ? 'from-indigo-600 to-indigo-400 hover:from-indigo-500 hover:to-indigo-300' : 'from-slate-300 to-slate-200 hover:from-slate-400 hover:to-slate-300' }} rounded-t-md transition-colors cursor-pointer relative"
                                        style="height: {{ $height }}%;">
                                        <div
                                            class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover/bar:opacity-100 transition-opacity whitespace-nowrap z-20 shadow-md">
                                            {{ number_format($score, 4) }}
                                        </div>
                                    </div>
                                    <div
                                        class="absolute -bottom-6 text-xs text-slate-500 font-semibold truncate w-full text-center">
                                        {{-- {{ $pref['alternatif']->kode }} --}}
                                        {{ $pref['alternatif']->objek->nama ?? 'Alternatif ' . $pref['alternatif']->id }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="w-full h-full flex items-center justify-center text-sm text-slate-400 italic">
                                Belum ada data perhitungan
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
