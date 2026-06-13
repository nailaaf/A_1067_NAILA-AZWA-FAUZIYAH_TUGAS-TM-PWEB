@extends('layouts.customer')

@section('title', 'Cek Pesanan - Cakeys')

@section('content')
<div class="dashboard-wrapper" style="padding-bottom: 50px;">
    <div class="dashboard-welcome" style="text-align: center; padding-top: 10px; margin-bottom: 40px;">
        <h3 style="color: var(--secondary-color);">Lacak Kue Bahagiamu</h3>
        <h1 style="margin-bottom: 10px;">Cek Status Pesanan</h1>
        <p style="max-width: 600px; margin: 0 auto; font-size: 0.95rem; line-height: 1.5;">
            Masukkan Nomor Resi (misal: ORD-A1B2C3) yang kamu dapatkan saat checkout untuk melihat status pesananmu secara real-time.
        </p>

        <form action="{{ route('cek-pesanan') }}" method="GET" style="margin-top: 25px; display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="resi" value="{{ request('resi') }}" placeholder="Masukkan Nomor Resi..." required style="padding: 12px 25px; width: 100%; max-width: 350px; border-radius: 30px; border: 2px solid var(--primary-color); background: var(--surface-color); color: var(--text-color); font-size: 1rem; outline: none;">

            <button type="submit" style="padding: 12px 35px; border-radius: 30px; background-color: var(--primary-color); color: white; border: none; font-weight: bold; font-size: 1rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='var(--secondary-color)'" onmouseout="this.style.backgroundColor='var(--primary-color)'">
                Lacak
            </button>
        </form>
    </div>

    @if(request('resi'))
        @if($pesanan)
            <div style="max-width: 800px; margin: 0 auto; background: var(--surface-color); border: 1px solid var(--border-color, #EFE8DF); border-radius: 15px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); animation: slideUp 0.4s ease-out;">

                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px dashed var(--border-color, #EFE8DF); padding-bottom: 15px; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <p style="margin: 0; color: var(--secondary-color); font-weight: 600; font-size: 0.9rem;">Nomor Resi</p>
                        <h2 style="margin: 5px 0 0 0; color: var(--primary-color); font-size: 1.5rem;">{{ $pesanan->no_pesanan }}</h2>
                    </div>
                    <div style="text-align: right;">
                        <p style="margin: 0; color: var(--secondary-color); font-weight: 600; font-size: 0.9rem;">Status Terkini</p>
                        @php
                            $warnaBg = '#f8d7da'; $warnaTeks = '#721c24'; // Default Merah (Menunggu Pembayaran)
                            if($pesanan->status == 'Diproses') { $warnaBg = '#fff3cd'; $warnaTeks = '#856404'; } // Kuning
                            elseif($pesanan->status == 'Proses Pengantaran' || $pesanan->status == 'Siap Diambil') { $warnaBg = '#cce5ff'; $warnaTeks = '#004085'; } // Biru
                            elseif($pesanan->status == 'Selesai') { $warnaBg = '#d4edda'; $warnaTeks = '#155724'; } // Hijau
                        @endphp
                        <span style="display: inline-block; margin-top: 5px; background-color: {{ $warnaBg }}; color: {{ $warnaTeks }}; padding: 6px 15px; border-radius: 20px; font-weight: bold; font-size: 0.95rem;">
                            {{ $pesanan->status }}
                        </span>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-bottom: 25px;">
                    <div>
                        <p style="margin: 0 0 5px 0; color: var(--secondary-color); font-size: 0.85rem;">Atas Nama</p>
                        <p style="margin: 0; font-weight: bold; font-size: 1rem;">{{ $pesanan->nama_pemesan }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 5px 0; color: var(--secondary-color); font-size: 0.85rem;">Metode</p>
                        <p style="margin: 0; font-weight: bold; font-size: 1rem;">{{ $pesanan->metode_pengambilan }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 5px 0; color: var(--secondary-color); font-size: 0.85rem;">Tgl Diperlukan</p>
                        <p style="margin: 0; font-weight: bold; font-size: 1rem;">{{ \Carbon\Carbon::parse($pesanan->tanggal_diperlukan)->format('d M Y') }}</p>
                    </div>
                </div>

                <h3 style="color: var(--primary-color); border-bottom: 1px solid var(--border-color, #EFE8DF); padding-bottom: 8px; margin-bottom: 15px; font-size: 1.1rem;">Kue yang Dipesan</h3>

                @foreach($pesanan->detail_pesanan as $detail)
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color, #EFE8DF); flex-wrap: wrap; gap: 10px;">
                        <div style="display: flex; gap: 15px; align-items: center;">
                            <img src="{{ asset($detail->produk->gambar) }}" alt="kue" style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover;">
                            <div>
                                <p style="margin: 0; font-weight: bold; font-size: 0.95rem;">{{ $detail->produk->nama_produk }} <span style="color: var(--secondary-color);">x{{ $detail->jumlah }}</span></p>
                                <p style="margin: 0; font-size: 0.8rem;">Catatan: {{ $detail->catatan }} | Add-on: Rp {{ number_format($detail->addon_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div style="font-weight: bold; font-size: 1rem;">
                            Rp {{ number_format(($detail->harga_kue + $detail->addon_harga) * $detail->jumlah, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <div style="text-align: right; margin-top: 20px;">
                    <p style="margin: 0; color: var(--secondary-color); font-size: 0.9rem; font-weight: 600;">Total Tagihan</p>
                    <h2 style="margin: 5px 0 0 0; color: var(--primary-color); font-size: 1.5rem;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h2>
                </div>
            </div>
        @else
            <div style="text-align: center; max-width: 400px; margin: 0 auto; padding: 25px; border: 2px dashed #dc3545; border-radius: 15px; background-color: rgba(220, 53, 69, 0.05);">
                <h1 style="font-size: 2.5rem; margin-bottom: 10px;">🥺</h1>
                <h3 style="color: #dc3545; margin-bottom: 10px; font-size: 1.2rem;">Pesanan Tidak Ditemukan!</h3>
                <p style="color: var(--text-color); font-size: 0.9rem; line-height: 1.5;">
                    Maaf, kami tidak dapat menemukan resi <strong>"{{ request('resi') }}"</strong>. Pastikan penulisan huruf dan angkanya sudah sesuai ya!
                </p>
            </div>
        @endif
    @endif
</div>

<style>
    @keyframes slideUp {
        from { transform: translateY(15px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>
@endsection
