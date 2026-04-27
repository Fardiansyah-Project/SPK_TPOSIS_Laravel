<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\ObjekController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PenilaianController;

Route::get('/', function () {
    return redirect()->route('topsis.index');
});

Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');

Route::resource('kriteria', KriteriaController::class);
Route::resource('sub-kriteria', SubKriteriaController::class);
Route::resource('objek', ObjekController::class);
Route::resource('alternatif', AlternatifController::class);
Route::resource('penilaian', PenilaianController::class);
