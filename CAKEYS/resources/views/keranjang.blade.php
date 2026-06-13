@extends('layouts.customer')

@section('title', 'Keranjang Belanja - Cakeys')

@section('content')
<style>
    .table-order-cart th {
        background-color: var(--primary-color) !important;
        color: white !important;
    }
    .table-order-cart tr:hover {
        background-color: rgba(140, 106, 93, 0.12) !important; /* Warna secondary dengan opasitas tipis agar tidak putih silau */
    }
</style>

<div class="dashboard-wrapper" style="padding: 40px 5%;">
    <div class="dashboard-welcome">
        <h3>Pesanan Anda</h3>
        <h1>Keranjang Belanja</h1>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if(count($keranjang) > 0)
        <div class="dashboard-section">
            <div class="table">
                <table class="table-order table-order-cart">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Rincian</th>
                            <th>Harga Satuan</th>
                            <th>Jml</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keranjang as $id => $item)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <img src="{{ asset($item['gambar']) }}" alt="Gambar" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                    <span style="font-weight: bold; color: var(--primary-color);">{{ $item['nama_produk'] }}</span>
                                </div>
                            </td>
                            <td style="font-size: 0.85rem; line-height: 1.4;">
                                <strong>Catatan:</strong> {{ $item['catatan'] }} <br>
                                <strong>Add-on:</strong> Rp {{ number_format($item['addon_harga'], 0, ',', '.') }}
                            </td>
                            <td>Rp {{ number_format($item['harga_kue'], 0, ',', '.') }}</td>
                            <td><strong>{{ $item['jumlah'] }}</strong></td>
                            <td style="font-weight: bold; color: var(--secondary-color);">
                                Rp {{ number_format(($item['harga_kue'] + $item['addon_harga']) * $item['jumlah'], 0, ',', '.') }}
                            </td>
                            <td>
                                <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-delete" style="padding: 6px 12px; font-size: 0.8rem;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="text-align: right; margin-top: 20px; font-size: 1.5rem; color: var(--primary-color);">
                <strong>Total Belanja: Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="dashboard-welcome" style="margin-top: 50px;">
            <h3>Langkah Terakhir</h3>
            <h1>Data Pengiriman</h1>
        </div>

        <div class="dashboard-section">
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--primary-color);">Nama Lengkap</label>
                        <input type="text" name="nama" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; background: var(--surface-color); color: var(--text-color); font-family: inherit;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--primary-color);">No. WhatsApp Aktif</label>
                        <input type="text" name="no_wa" required placeholder="08..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; background: var(--surface-color); color: var(--text-color); font-family: inherit;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--primary-color);">Metode Pengambilan</label>
                    <select name="metode" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; background: var(--surface-color); color: var(--text-color); font-family: inherit;">
                        <option value="Ambil di Toko">Ambil Sendiri di Toko (Jl. Jember No. 1)</option>
                        <option value="Kirim Kurir">Kirim via Kurir Lokal (Biaya kirim bayar di tempat)</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--primary-color);">Alamat Lengkap (Jika dikirim, abaikan jika ambil di toko)</label>
                    <textarea name="alamat" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; background: var(--surface-color); color: var(--text-color); font-family: inherit;"></textarea>
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--primary-color);">Tanggal Diperlukan</label>
                    <input type="date" name="tanggal" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; background: var(--surface-color); color: var(--text-color); font-family: inherit;">
                </div>

                <button type="submit" style="width: 100%; padding: 15px; background-color: var(--primary-color); color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 1.1rem; transition: 0.3s;" onmouseover="this.style.backgroundColor='var(--secondary-color)'" onmouseout="this.style.backgroundColor='var(--primary-color)'">
                    Selesaikan Pesanan & Lanjut ke WhatsApp
                </button>
            </form>
        </div>

    @else
        <div class="dashboard-section" style="text-align: center; padding: 60px 20px;">
            <h2 style="color: var(--secondary-color); margin-bottom: 15px;">Keranjangmu masih kosong nih 🥺</h2>
            <p style="margin-bottom: 25px;">Yuk pilih kue favoritmu dulu di Katalog!</p>
            <a href="{{ route('katalog') }}" style="display: inline-block; padding: 12px 30px; background-color: var(--accent-color); color: #fff; font-weight: bold; border-radius: 30px; transition: 0.3s;">Belanja Sekarang</a>
        </div>
    @endif
</div>
@endsection
