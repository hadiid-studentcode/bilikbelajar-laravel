<?php

use App\Http\Controllers\Guru\CapaianTujuanPembelajaranController as GuruCapaianTujuanPembelajaranController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  dd('halaman home');
});

// Route::get('/404', function () {
//     return view('404');
// });

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
        Route::post('/store', [GuruMateriController::class, 'store'])->name('store');
    });
});

Route::name('siswa.')->group(function () {
    Route::get('/materi', function () {
        dd('siswa materi');
    })->name('materi');
});


include __DIR__ . '/auth.php';
