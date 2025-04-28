<?php

use App\Http\Controllers\Guru\CapaianPembelajaranController as GuruCapaianPembelajaranController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\EvaluasiController as GuruEvaluasiController;
use App\Http\Controllers\Guru\KuisController as GuruKuisController;
use App\Http\Controllers\Guru\ManajemenSiswaController as GuruManajemenSiswaController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Guru\ProfileController as GuruProfileController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\EvaluasiController as SiswaEvaluasiController;
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

    Route::prefix('/capaian-pembelajaran')->name('cp.')->group(function () {
        Route::get('/', [GuruCapaianPembelajaranController::class, 'index'])->name('index');
        Route::post('/store', [GuruCapaianPembelajaranController::class, 'store'])->name('store');
        Route::put('/update/{kelas}', [GuruCapaianPembelajaranController::class, 'update'])->name('update');
        Route::delete('/destroy/{kelas}', [GuruCapaianPembelajaranController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/manajemen-siswa')->name('manajemen-siswa.')->group(function () {
        Route::get('/', [GuruManajemenSiswaController::class, 'index'])->name('index');
        Route::post('/store', [GuruManajemenSiswaController::class, 'store'])->name('store');
        Route::put('/update/{id}', [GuruManajemenSiswaController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [GuruManajemenSiswaController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('/materi')->name('materi.')->group(function () {
        Route::get('/', [GuruMateriController::class, 'index'])->name('index');
        Route::get('/kelas/{id}', [GuruMateriController::class, 'kelas'])->name('kelas');
        Route::post('/store', [GuruMateriController::class, 'store'])->name('store');
        Route::post('/tp', [GuruMateriController::class, 'storeTp'])->name('storeTp');
        Route::put('/tp/{tp_id}', [GuruMateriController::class, 'updateTp'])->name('updateTp');

        Route::put('/{id}', [GuruMateriController::class, 'update'])->name('update');
        Route::delete('/{id}', [GuruMateriController::class, 'destroy'])->name('destroy');

        Route::prefix('/kuis')->name('kuis.')->group(function () {
            Route::get('/{materi_id}', [GuruKuisController::class, 'index'])->name('index');
            Route::post('/{materi_id}/store', [GuruKuisController::class, 'store'])->name('store');
            Route::put('/{materi_id}/update', [GuruKuisController::class, 'update'])->name('update');
            Route::delete('/{materi_id}/destroy', [GuruKuisController::class, 'destroy'])->name('destroy');
            Route::delete('/{nilaiKuis_id}/destroy-nilaiKuis', [GuruKuisController::class, 'destroyNilaiKuis'])->name('destroy.nilaiKuis');
        });

        Route::prefix('/evaluasi')->name('evaluasi.')->group(function () {
            Route::get('/{materi_id}', [GuruEvaluasiController::class, 'index'])->name('index');
            Route::post('/{materi_id}/store', [GuruEvaluasiController::class, 'store'])->name('store');
            Route::put('/{materi_id}/update', [GuruEvaluasiController::class, 'update'])->name('update');
            Route::delete('/{materi_id}/destroy', [GuruEvaluasiController::class, 'destroy'])->name('destroy');
            Route::put('/{nilaiEvaluasi_id}/updateNilaiEvaluasi', [GuruEvaluasiController::class, 'updateNilaiEvaluasi'])->name('update.nilaiEvaluasi');
            Route::delete('/{nilaiEvaluasi_id}/destroy-nilaiEvaluasi', [GuruEvaluasiController::class, 'destroyNilaiEvaluasi'])->name('destroy.nilaiEvaluasi');
        });
      
    });
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [GuruProfileController::class, 'index'])->name('index');
        Route::put('/update/{id}', [GuruProfileController::class, 'update'])->name('update');
        // Route::post('/{materi_id}/store', [GuruEvaluasiController::class, 'store'])->name('store');
        // Route::delete('/{materi_id}/destroy', [GuruEvaluasiController::class, 'destroy'])->name('destroy');
        // Route::put('/{nilaiEvaluasi_id}/updateNilaiEvaluasi', [GuruEvaluasiController::class, 'updateNilaiEvaluasi'])->name('update.nilaiEvaluasi');
        // Route::delete('/{nilaiEvaluasi_id}/destroy-nilaiEvaluasi', [GuruEvaluasiController::class, 'destroyNilaiEvaluasi'])->name('destroy.nilaiEvaluasi');
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
    Route::prefix('/evaluasi')->name('evaluasi.')->group(function () {
        Route::get('/{materi_id}', [SiswaEvaluasiController::class, 'index'])->name('index');
        Route::post('/store', [SiswaEvaluasiController::class, 'store'])->name('store');
    });
});

include __DIR__ . '/auth.php';
