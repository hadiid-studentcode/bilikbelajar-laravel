<?php

use App\Http\Controllers\Guru\CapaianTujuanPembelajaranController as GuruCapaianTujuanPembelajaranController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\KuisController as GuruKuisController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\KuisController as SiswaKuisController;
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('guru.dashboard.index');
    }
    if (session('siswa')) {
        return redirect()->route('siswa.dashboard.index');
    }

    return view('welcome');
})->name('home');

Route::middleware('auth')->prefix('guru')->name('guru.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('guru.dashboard.index');
    });

    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [GuruDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('/cptp')->name('cptp.')->group(function () {
        Route::get('/', [GuruCapaianTujuanPembelajaranController::class, 'index'])->name('index');
        Route::post('/store', [GuruCapaianTujuanPembelajaranController::class, 'store'])->name('store');
        Route::put('/put/{cp}/{tp}', [GuruCapaianTujuanPembelajaranController::class, 'update'])->name('update');
        Route::delete('/destroy/{cp}/{tp}', [GuruCapaianTujuanPembelajaranController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/materi')->name('materi.')->group(function () {
        Route::get('/', [GuruMateriController::class, 'index'])->name('index');
        Route::get('/kelas/{id}', [GuruMateriController::class, 'kelas'])->name('kelas');
        Route::post('/store', [GuruMateriController::class, 'store'])->name('store');
        Route::put('/{id}', [GuruMateriController::class, 'update'])->name('update');
        Route::delete('/{id}', [GuruMateriController::class, 'destroy'])->name('destroy');

        Route::prefix('/kuis')->name('kuis.')->group(function () {
            Route::get('/{materi_id}', [GuruKuisController::class, 'index'])->name('index');
            Route::post('/{materi_id}/store', [GuruKuisController::class, 'store'])->name('store');
            Route::put('/{materi_id}/update', [GuruKuisController::class, 'update'])->name('update');
            Route::delete('/{materi_id}/destroy', [GuruKuisController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::prefix('/siswa')->name('siswa.')->group(function () {
    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [SiswaDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('/materi')->name('materi.')->group(function () {
        Route::get('/{materi_id}', [SiswaMateriController::class, 'show'])->name('show');
    });

    Route::prefix('/kuis')->name('kuis.')->group(function () {
        Route::get('/{materi_id}', [SiswaKuisController::class, 'index'])->name('index');
        Route::post('/store', [SiswaKuisController::class, 'store'])->name('store');
    });
});

include __DIR__.'/auth.php';
