@extends('layouts.app')

@section('title', 'Detail Pesanan ' . $pesanan->no_pesanan . ' - Cakeys')

@section('content')
<div class="dashboard-wrapper">
    <a href="{{ route('pesanan.index') }}" style="color: #6c757d; font-weight: 600; margin-bottom: 20px; display: inline-block; text-decoration: none;">
        ← Kembali ke Daftar Pesanan
    </a>

    <div class="dashboard-welcome">
        <h3>Detail Transaksi</h3>
        <h1>{{ $pesanan->no_pesanan }}</h1>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-top: 20px; border-radius: 8px; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px;">
        <div class="dashboard-section" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 0;">
            <h2 style="font-size: 1.2rem; color: var(--primary-color); margin-bottom: 15px; border-bottom: 2px solid #f4e8e1; padding-bottom: 10px;">Informasi Pelanggan</h2>
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px; font-size: 0.95em;">
                <tr><td style="width: 140px; color: #666; font-weight: 600;">Nama Pemesan</td> <td style="color: #333;">: <strong>{{ $pesanan->nama_pemesan }}</strong></td></tr>
                <tr><td style="color: #666; font-weight: 600;">No. WhatsApp</td> <td style="color: #333;">: {{ $pesanan->no_wa }}</td></tr>
                <tr><td style="color: #666; font-weight: 600;">Metode</td> <td style="color: #333;">: {{ $pesanan->metode_pengambilan }}</td></tr>
                <tr><td style="color: #666; font-weight: 600;">Tgl Diperlukan</td> <td style="color: #333;">: <strong>{{ \Carbon\Carbon::parse($pesanan->tanggal_diperlukan)->format('d M Y') }}</strong></td></tr>
                <tr><td style="vertical-align: top; color: #666; font-weight: 600;">Alamat</td> <td style="color: #333;">: {{ $pesanan->alamat ?? '-' }}</td></tr>
            </table>
        </div>

        <div class="dashboard-section" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 0;">
            <h2 style="font-size: 1.2rem; color: var(--primary-color); margin-bottom: 15px; border-bottom: 2px solid #f4e8e1; padding-bottom: 10px;">Update Status</h2>

            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                @csrf
                <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #555;">Status Saat Ini:</label>
                <select name="status" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; background: #f9f9f9; color: #333; margin-bottom: 20px; font-size: 0.95em;">
                    <option value="Menunggu Pembayaran" {{ $pesanan->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="Diproses" {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>Diproses (Sedang Dibuat)</option>
                    <option value="Proses Pengantaran" {{ $pesanan->status == 'Proses Pengantaran' ? 'selected' : '' }}>Proses Pengantaran</option>
                    <option value="Siap Diambil" {{ $pesanan->status == 'Siap Diambil' ? 'selected' : '' }}>Siap Diambil di Toko</option>
                    <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>

                <button type="submit" style="width: 100%; padding: 12px; background-color: #ffc107; color: #333; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 0.95em; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Simpan & Update Status
                </button>
            </form>
        </div>
    </div>

    <div class="dashboard-section mt-4" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h2 style="font-size: 1.2rem; color: var(--primary-color); margin-bottom: 20px; border-bottom: 2px solid #f4e8e1; padding-bottom: 10px;">Daftar Kue yang Dipesan</h2>

        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background-color: #f9f9f9; color: #555;">
                <tr>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Produk</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Catatan & Add-on</th>
                    <th style="padding: 12px; text-align: center; border-bottom: 1px solid #ddd;">Jml</th>
                    <th style="padding: 12px; text-align: right; border-bottom: 1px solid #ddd;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan->detail_pesanan as $detail)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <img src="{{ asset($detail->produk->gambar) }}" alt="Kue" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                            <div>
                                <h3 style="margin: 0; font-size: 0.95rem; color: var(--primary-color);">{{ $detail->produk->nama_produk }}</h3>
                                <p style="margin: 0; font-size: 0.85rem; color: #666;">Rp {{ number_format($detail->harga_kue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 15px; font-size: 0.85rem; color: #555; line-height: 1.5;">
                        <strong>Catatan:</strong> {{ $detail->catatan }} <br>
                        <strong>Add-on:</strong> Rp {{ number_format($detail->addon_harga, 0, ',', '.') }}
                    </td>
                    <td style="padding: 15px; text-align: center; font-weight: bold; color: #333;">{{ $detail->jumlah }}</td>
                    <td style="padding: 15px; text-align: right; font-weight: bold; color: var(--primary-color);">
                        Rp {{ number_format(($detail->harga_kue + $detail->addon_harga) * $detail->jumlah, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: right; margin-top: 25px; padding-top: 15px; border-top: 2px dashed #ddd;">
            <h2 style="font-size: 1.4rem; margin: 0; color: #333;">Grand Total: <span style="color: var(--primary-color);">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></h2>
        </div>
    </div>
</div>

@if(session('whatsapp_url'))
<div id="waModalAdmin" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); display: flex; align-items: center; justify-content: center; z-index: 99999; opacity: 0; animation: fadeIn 0.3s forwards;">
    <div style="background-color: white; padding: 40px; border-radius: 15px; max-width: 450px; width: 90%; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">
        <div style="font-size: 3.5rem; margin-bottom: 15px;">🛵</div>
        <h2 style="color: var(--primary-color); margin-bottom: 15px; font-weight: bold; font-size: 1.5rem;">Status Sukses Diupdate!</h2>
        <p style="margin-bottom: 30px; font-size: 0.95rem; line-height: 1.6; color: #555;">
            Klik tombol di bawah ini untuk mengirim pesan otomatis ke WhatsApp <strong>{{ $pesanan->nama_pemesan }}</strong> dan memberitahu bahwa pesanannya sedang dikirim / siap diambil!
        </p>
        <div style="display: flex; gap: 15px; justify-content: center;">
            <button onclick="document.getElementById('waModalAdmin').style.display='none'" style="padding: 10px 20px; border-radius: 8px; border: 1px solid #ccc; background: #f9f9f9; color: #555; cursor: pointer; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='#eee'" onmouseout="this.style.backgroundColor='#f9f9f9'">Tutup</button>

            <a href="{{ session('whatsapp_url') }}" target="_blank" onclick="document.getElementById('waModalAdmin').style.display='none'" style="padding: 10px 25px; border-radius: 8px; background-color: #25D366; color: white; text-decoration: none; font-weight: bold; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3); transition: 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Chat Customer 💬</a>
        </div>
    </div>
</div>
<style>
    @keyframes fadeIn { to { opacity: 1; } }
    @keyframes slideUp { to { transform: translateY(0); } }
</style>
@endif

<style>
    /* ================= RESPONSIVE DETAIL PESANAN ================= */
    @media (max-width: 850px) {
        /* 1. Susun kotak Informasi Pelanggan dan Update Status jadi atas-bawah */
        .dashboard-wrapper > div[style*="display: grid"] {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }

        /* 2. Beri kemampuan scroll horizontal pada tabel Daftar Kue */
        .dashboard-section table {
            display: block;
            overflow-x: auto;
            white-space: nowrap; /* Menjaga teks tidak turun berantakan saat digeser */
            width: 100%;
        }

        /* 3. Khusus kolom pertama (Produk), batasi ukuran teks dan gambarnya */
        .dashboard-section table tbody tr td:first-child div {
            min-width: 250px;
            white-space: normal; /* Biarkan nama produk bisa turun baris jika sangat panjang */
        }
    }
</style>

@endsection
