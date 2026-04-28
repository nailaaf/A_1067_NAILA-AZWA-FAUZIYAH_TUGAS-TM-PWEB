@extends('layouts.app')

@section('content')
<div class="main-content">
    <h1 style="color: var(--primary-color); margin-bottom: 20px; font-weight: 700;">Pengelolaan Produk</h1>

    <div class="top-bar">
        <input type="text" id="search" placeholder="Cari nama atau kode produk...">
        <ul class="filter-list">
            <li class="active">Semua Kategori</li>
            @foreach($kategori as $k)
                <li>{{ ucfirst($k) }}</li>
            @endforeach
        </ul>
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
        <button type="button">Tambah Produk</button>
    </form>

    <div class="produk-grid">
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
