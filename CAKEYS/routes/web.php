<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    $session = request()->session();

    $visits = $session->get('kunjungan', 0) + 1;
    $session->put('kunjungan', $visits);

    if (!$session->has('waktu_pertama')) {
        $session->put('waktu_pertama', now()->format('Y-m-d H:i:s'));
    }

    $session->put('waktu_terakhir', now()->format('Y-m-d H:i:s'));

    return view('welcome', [
        'visits' => $visits,
        'waktu_pertama' => $session->get('waktu_pertama'),
        'waktu_terakhir' => $session->get('waktu_terakhir')
    ]);
})->name('home');

Route::post('/reset-kunjungan', function () {
    request()->session()->forget(['kunjungan', 'waktu_pertama', 'waktu_terakhir']);

    return redirect()->back();
})->name('kunjungan.reset');

Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/kontak', 'kontak')->name('kontak');
Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/search', [KatalogController::class, 'search'])->name('katalog.search');
Route::get('/katalog/{id}', [App\Http\Controllers\KatalogController::class, 'show'])->name('katalog.show');

Route::get('/cek-pesanan', [PesananController::class, 'lacak'])->name('cek-pesanan');


Route::middleware(['auth', 'cekowner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- RUTE KELOLA PESANAN (BARU) ---
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{id}/update', [PesananController::class, 'updateStatus'])->name('pesanan.update');
    // ----------------------------------
    // --- RUTE LAPORAN ---
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // --- RUTE PREFERENSI OWNER ---
    Route::get('/owner/preferensi', function () {
        return view('preferensi-owner');
    })->name('owner.preferensi');

    // RUTE HALAMAN PROFIL UTAMA (CARD)
    Route::get('/profil-saya', function () {
        return view('profile.index');
    })->name('profile.index');

    Route::resource('produk', ProdukController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/preferensi', [PreferensiController::class, 'index'])->name('preferensi');
Route::post('/preferensi/simpan', [PreferensiController::class, 'simpan'])->name('preferensi.simpan');

Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');

require __DIR__.'/auth.php';
