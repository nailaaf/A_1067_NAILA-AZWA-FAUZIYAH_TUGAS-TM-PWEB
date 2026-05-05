<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/kontak', 'kontak')->name('kontak');

Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);
