<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/kontak', 'kontak')->name('kontak');
Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);


Route::middleware(['auth', 'cekowner'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

    Route::resource('produk', ProdukController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
