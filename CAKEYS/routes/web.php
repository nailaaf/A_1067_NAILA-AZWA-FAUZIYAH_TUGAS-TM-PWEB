<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PreferensiController;

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


Route::middleware(['auth', 'cekowner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

    Route::resource('produk', ProdukController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/preferensi', [PreferensiController::class, 'index'])->name('preferensi');
Route::post('/preferensi/simpan', [PreferensiController::class, 'simpan'])->name('preferensi.simpan');

require __DIR__.'/auth.php';
