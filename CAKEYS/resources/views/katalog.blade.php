@extends('layouts.app')

@section('content')
<div class="katalog-container">
    <h1 class="pengelolaan-katalog"">Pengelolaan Produk</h1>
    <div class="top-bar">
        <input type="text" id="search" placeholder="Cari nama atau kode produk...">

        <div class="katalog-filter">
            <ul class="filter-list">
                <li class="active">Semua Kategori</li>
                @foreach($kategori as $k)
                    <li style="text-transform: capitalize;>{{ ucfirst($k) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <form id="form-produk">
        <input type="file" id="gambar" accept="image/*">
        <input type="text" id="kode" placeholder="Kode Produk">
        <input type="text" id="nama" placeholder="Nama Produk">
        <select id="kategori_input">
            <option value="">Kategori</option>
            @foreach($kategori as $k)
                <option value="{{ strtolower($k) }}">{{ ucfirst($k) }}</option>
            @endforeach
        </select>
        <input type="number" id="stok" placeholder="Stok">
        <input type="number" id="harga" placeholder="Harga">
        <input type="date" id="tanggal">
        <button type="button">Tambah Produk</button>
    </form>

    <div class="produk-grid" id="product-grid">
        @foreach ($produk as $p)
        <div class="produk-card">
            <div class="card-image">
                <img src="{{ asset($p['images']) }}" alt="{{ $p['nama_produk'] }}">

                <span class="badge-kategori">{{ ucfirst($p['kategori']) }}</span>
            </div>

            <div class="card-details">
                <p class="kue-id">{{ $p['id_produk'] }}</p>
                <h3 class="kue-nama">{{ $p['nama_produk'] }}</h3>
                <p class="kue-harga">Rp {{ number_format($p['harga'], 0, ',', '.') }}</p>

                <div class="kue-stok">
                    @if($p['stok'] <= 5)
                        <span class="stok-warning">Sisa Stok: {{ $p['stok'] }}</span>
                    @else
                        <span class="stok-aman">Stok: {{ $p['stok'] }}</span>
                    @endif
                </div>

                <div class="card-actions">
                    <button class="btn-edit">Edit</button>
                    <button class="btn-delete">Hapus</button>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let customAlert = document.createElement('div');
        customAlert.innerHTML = "🎂 <strong>Selamat Datang!</strong> Selamat memilih-milih kue di Katalog Cakeys.";

        Object.assign(customAlert.style, {
            position: 'fixed',
            top: '90px',
            right: '20px',
            backgroundColor: '#5A3E36',
            color: '#F9F6F0',
            padding: '15px 25px',
            borderRadius: '12px',
            boxShadow: '0 8px 20px rgba(0,0,0,0.15)',
            fontFamily: "'Poppins', sans-serif",
            fontSize: '0.95rem',
            zIndex: '10000',
            opacity: '0',
            transform: 'translateY(-20px)',
            transition: 'all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)'
        });

        document.body.appendChild(customAlert);

        setTimeout(() => {
            customAlert.style.opacity = '1';
            customAlert.style.transform = 'translateY(0)';
        }, 100);

        setTimeout(() => {
            customAlert.style.opacity = '0';
            customAlert.style.transform = 'translateY(-20px)';
            setTimeout(() => customAlert.remove(), 500);
        }, 3500);
    });
</script>
@endpush
