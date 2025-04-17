<?php

use App\Http\Controllers\Guru\LoginController as GuruLoginController;
use App\Http\Controllers\Siswa\LoginController as SiswaLoginController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [GuruLoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [GuruLoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');

Route::post('/logout', [GuruLoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/siswa', [SiswaLoginController::class, 'index'])->name('siswa');
Route::post('/siswa', [SiswaLoginController::class, 'login'])->name('siswa.login');
Route::get('/siswa/logout', [SiswaLoginController::class, 'logout'])->name('siswa.logout');
