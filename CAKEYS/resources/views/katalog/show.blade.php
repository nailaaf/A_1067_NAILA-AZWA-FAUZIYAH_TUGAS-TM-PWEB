@extends('layouts.customer')

@section('title', $produk->nama_produk . ' - Cakeys')

@section('content')
<div class="dashboard-wrapper" style="padding: 40px 5%;">

    <a href="{{ route('katalog') }}" style="color: var(--secondary-color); font-weight: 600; margin-bottom: 20px; display: inline-block;">
        ← Kembali ke Katalog
    </a>

    <div class="dashboard-section" style="max-width: 950px; margin: 0 auto; padding: 30px;">
        <div style="display: flex; flex-wrap: wrap; gap: 35px; align-items: flex-start;">

            <div style="flex: 0 0 40%; min-width: 280px;">
                <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: auto; max-height: 380px; border-radius: 12px; object-fit: cover; box-shadow: var(--shadow-md);">
            </div>

            <div style="flex: 1; min-width: 300px;">
                <span class="badge-kategori" style="position: static; display: inline-block; margin-bottom: 10px;">
                    {{ ucfirst($produk->kategori) }}
                </span>

                <h2 class="kue-nama" style="font-size: 1.8rem; margin-top: 10px;">{{ $produk->nama_produk }}</h2>
                <p class="kue-harga" style="font-size: 1.4rem; margin-bottom: 15px;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

                <p style="margin-bottom: 20px; font-size: 0.95rem; white-space: pre-line;">
                    {{ $produk->deskripsi ?? 'Kue premium spesial buatan Cakeys dengan resep terbaik.' }}
                </p>

                <div class="kue-stok" style="margin-bottom: 20px;">
                    @if($produk->stok <= 5)
                        <span class="stok-warning">Sisa Stok: {{ $produk->stok }}</span>
                    @else
                        <span class="stok-aman">Stok Tersedia: {{ $produk->stok }}</span>
                    @endif
                </div>

                <form action="{{ route('keranjang.tambah') }}" method="POST" style="border-top: 1px solid #EFE8DF; padding-top: 20px;">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 0.9rem; color: var(--primary-color);">Tulisan di atas Kue (Opsional)</label>
                        <input type="text" name="catatan" placeholder="Contoh: Happy Birthday Naila!" style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; font-family: inherit; background-color: var(--surface-color); color: var(--text-color);">
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 0.9rem; color: var(--primary-color);">Add-on Tambahan (Opsional)</label>
                        <select name="addon" style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; font-family: inherit; background-color: var(--surface-color); color: var(--text-color);">
                            <option value="0">Tidak Perlu Add-on</option>
                            <option value="3000">Lilin Angka (+ Rp 3.000)</option>
                            <option value="2000">Kartu Ucapan (+ Rp 2.000)</option>
                            <option value="5000">Topper Happy Birthday (+ Rp 5.000)</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 0.9rem; color: var(--primary-color);">Jumlah Pesanan</label>
                        <input type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}" style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; font-family: inherit; background-color: var(--surface-color); color: var(--text-color);">
                    </div>

                    <button type="submit" style="width: 100%; padding: 12px; background-color: var(--primary-color); color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='var(--secondary-color)'" onmouseout="this.style.backgroundColor='var(--primary-color)'">
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
