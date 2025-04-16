<?php

use App\Http\Controllers\Guru\CapaianTujuanPembelajaranController as GuruCapaianTujuanPembelajaranController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/404', function () {
    return view('404');
});


Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/', function () {
        return back();
    });


    Route::prefix('/cptp')->name('cptp.')->group(function () {
        Route::get('/', [GuruCapaianTujuanPembelajaranController::class, 'index'])->name('index');
        Route::post('/store', [GuruCapaianTujuanPembelajaranController::class, 'store'])->name('store');
        Route::delete('/destroy/{cp}/{tp}', [GuruCapaianTujuanPembelajaranController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('/materi')->name('materi.')->group(function () {
        Route::get('/', [GuruMateriController::class, 'index'])->name('index');
        Route::post('/store', [GuruMateriController::class, 'index'])->name('store');
    });

});






Route::name('siswa.')->group(function () {
    Route::get('/materi', function () {
        dd('siswa materi');
    })->name('materi');
});
