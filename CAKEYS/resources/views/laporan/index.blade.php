@extends('layouts.app')

@section('title', 'Laporan Analytics - Cakeys')

@section('content')

@php
    // --- 1. OLAH DATA GRAFIK PENJUALAN & KEUANGAN (TREN HARIAN) ---
    $grafikTanggal = [];
    $grafikPendapatan = [];
    $grafikTransaksi = [];

    // Urutkan dari terlama ke terbaru agar grafik maju ke kanan
    $penjualanTerurut = $laporanPenjualan->sortBy('created_at');

    foreach($penjualanTerurut as $p) {
        $tgl = \Carbon\Carbon::parse($p->created_at)->format('d M Y');
        if(!in_array($tgl, $grafikTanggal)) {
            $grafikTanggal[] = $tgl;
            $grafikPendapatan[$tgl] = 0;
            $grafikTransaksi[$tgl] = 0;
        }
        $grafikPendapatan[$tgl] += $p->total_harga;
        $grafikTransaksi[$tgl] += 1;
    }

    // --- 2. OLAH DATA GRAFIK PERFORMA PRODUK (TOP 5) ---
    $perfLabels = [];
    $perfData = [];
    foreach(array_slice($performaProduk, 0, 5) as $perf) {
        $perfLabels[] = $perf['nama'];
        $perfData[] = $perf['terjual'];
    }

    // --- 3. OLAH DATA GRAFIK STOK PRODUK ---
    $stokLabels = [];
    $stokData = [];
    $stokColors = [];
    foreach($laporanStok as $stok) {
        $stokLabels[] = $stok->nama_produk;
        $stokData[] = $stok->stok;
        // Warnai merah jika stok <= 5, hijau jika aman
        $stokColors[] = $stok->stok <= 5 ? 'rgba(220, 53, 69, 0.8)' : 'rgba(22, 163, 74, 0.8)';
    }
@endphp

<div class="dashboard-wrapper">
    <div class="dashboard-welcome" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
        <div class="welcome-text">
            <h3>Analisis Bisnis</h3>
            <h1>Laporan Analytics Cakeys</h1>
        </div>

        <form class="form-filter-laporan" action="{{ route('laporan.index') }}" method="GET" style="background: white; padding: 15px 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #666; margin-bottom: 5px;">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; outline: none; font-family: inherit;">
            </div>
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #666; margin-bottom: 5px;">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; outline: none; font-family: inherit;">
            </div>
            <div class="filter-actions" style="display: flex; gap: 10px;">
                <button type="submit" style="padding: 9px 20px; background-color: var(--primary-color); color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Filter</button>
                @if(request('start_date') || request('end_date'))
                    <a href="{{ route('laporan.index') }}" style="padding: 9px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; text-align: center; transition: 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="dashboard-section mt-4" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">

        <div class="tabs-header" style="display: flex; gap: 10px; border-bottom: 2px solid #EFE8DF; margin-bottom: 30px; overflow-x: auto; overflow-y: hidden; white-space: nowrap;">
            <button class="tab-btn active" onclick="openTab(event, 'tab-penjualan')">Laporan Penjualan</button>
            <button class="tab-btn" onclick="openTab(event, 'tab-keuangan')">Laporan Keuangan</button>
            <button class="tab-btn" onclick="openTab(event, 'tab-performa')">Performa Produk</button>
            <button class="tab-btn" onclick="openTab(event, 'tab-stok')">Laporan Stok</button>
        </div>

        <div id="tab-penjualan" class="tab-content" style="display: block; animation: fadeIn 0.4s;">
            <div class="header-tab-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                <h2 style="color: var(--primary-color); margin: 0;">Data Transaksi Sukses</h2>
                <span style="background: #f4e8e1; color: var(--primary-color); padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 0.9rem;">Total: {{ $totalTransaksi }} Transaksi</span>
            </div>

            <div style="overflow-x: auto; margin-bottom: 30px;">
                <table class="table-order" style="width: 100%; border-collapse: collapse; min-width: 800px;">
                    <thead style="background-color: var(--primary-color); color: white;">
                        <tr>
                            <th style="padding: 12px; text-align: left;">Tanggal</th>
                            <th style="padding: 12px; text-align: left;">No Resi</th>
                            <th style="padding: 12px; text-align: left;">Pelanggan</th>
                            <th style="padding: 12px; text-align: left;">Metode</th>
                            <th style="padding: 12px; text-align: right;">Nominal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporanPenjualan as $p)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 12px;">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>
                            <td style="padding: 12px; font-weight: bold;">{{ $p->no_pesanan }}</td>
                            <td style="padding: 12px;">{{ $p->nama_pemesan }}</td>
                            <td style="padding: 12px;">{{ $p->metode_pengambilan }}</td>
                            <td style="padding: 12px; text-align: right; font-weight: bold; color: var(--primary-color);">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" style="padding: 20px; text-align: center; color: #888;">Tidak ada data penjualan pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 12px; padding: 20px;">
                <h4 style="margin-top: 0; color: #666; margin-bottom: 15px; text-align: center;">Grafik Tren Penjualan Harian</h4>
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="penjualanChart"></canvas>
                </div>
            </div>
        </div>

        <div id="tab-keuangan" class="tab-content" style="display: none; animation: fadeIn 0.4s;">
            <h2 style="color: var(--primary-color); margin-bottom: 20px;">Ringkasan Pendapatan</h2>

            <div class="card-keuangan" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); padding: 30px; border-radius: 12px; color: white; display: inline-block; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(90, 62, 54, 0.3);">
                <p style="margin: 0 0 5px 0; font-size: 1rem; opacity: 0.9;">Total Pendapatan (Selesai)</p>
                <h1 style="margin: 0; font-size: 2.5rem;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h1>
                <p style="margin: 10px 0 0 0; font-size: 0.85rem; opacity: 0.8;">
                    @if(request('start_date') && request('end_date'))
                        Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                    @else
                        Periode: Sepanjang Masa
                    @endif
                </p>
            </div>

            <div style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 12px; padding: 20px;">
                <h4 style="margin-top: 0; color: #666; margin-bottom: 15px; text-align: center;">Grafik Jumlah Transaksi Harian</h4>
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="keuanganChart"></canvas>
                </div>
            </div>
        </div>

        <div id="tab-performa" class="tab-content" style="display: none; animation: fadeIn 0.4s;">
            <h2 style="color: var(--primary-color); margin-bottom: 15px;">Peringkat Kue Terlaris</h2>

            <div style="overflow-x: auto; margin-bottom: 30px;">
                <table class="table-order" style="width: 100%; border-collapse: collapse; min-width: 800px;">
                    <thead style="background-color: var(--primary-color); color: white;">
                        <tr>
                            <th style="padding: 12px; text-align: center; width: 50px;">Rank</th>
                            <th style="padding: 12px; text-align: left;">Kode</th>
                            <th style="padding: 12px; text-align: left;">Nama Produk</th>
                            <th style="padding: 12px; text-align: center;">Total Terjual</th>
                            <th style="padding: 12px; text-align: right;">Sumbangan Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rank = 1; @endphp
                        @forelse($performaProduk as $prod)
                        <tr style="border-bottom: 1px solid #ddd; background: {{ $rank <= 3 ? '#fffaf0' : 'white' }};">
                            <td style="padding: 12px; text-align: center; font-weight: bold; font-size: 1.1rem; color: {{ $rank == 1 ? '#D97706' : ($rank == 2 ? '#6B7280' : ($rank == 3 ? '#92400E' : '#333')) }};">
                                #{{ $rank }}
                            </td>
                            <td style="padding: 12px;">{{ $prod['kode'] }}</td>
                            <td style="padding: 12px; font-weight: bold;">{{ $prod['nama'] }}</td>
                            <td style="padding: 12px; text-align: center;">
                                <span style="background: var(--primary-color); color: white; padding: 3px 10px; border-radius: 15px; font-size: 0.85rem;">{{ $prod['terjual'] }} Pcs</span>
                            </td>
                            <td style="padding: 12px; text-align: right; color: var(--primary-color); font-weight: bold;">Rp {{ number_format($prod['pendapatan'], 0, ',', '.') }}</td>
                        </tr>
                        @php $rank++; @endphp
                        @empty
                        <tr><td colspan="5" style="padding: 20px; text-align: center; color: #888;">Belum ada data penjualan produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 12px; padding: 20px;">
                <h4 style="margin-top: 0; color: #666; margin-bottom: 15px; text-align: center;">Proporsi Top 5 Produk Terlaris</h4>
                <div style="position: relative; height: 350px; width: 100%; display: flex; justify-content: center;">
                    <canvas id="performaChart"></canvas>
                </div>
            </div>
        </div>

        <div id="tab-stok" class="tab-content" style="display: none; animation: fadeIn 0.4s;">
            <div class="header-tab-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                <h2 style="color: var(--primary-color); margin: 0;">Status Stok Real-Time</h2>
                <small style="color: #666;">*Filter tanggal tidak mempengaruhi data stok.</small>
            </div>

            <div style="overflow-x: auto; margin-bottom: 30px;">
                <table class="table-order" style="width: 100%; border-collapse: collapse; min-width: 700px;">
                    <thead style="background-color: var(--primary-color); color: white;">
                        <tr>
                            <th style="padding: 12px; text-align: left;">Kode</th>
                            <th style="padding: 12px; text-align: left;">Nama Produk</th>
                            <th style="padding: 12px; text-align: left;">Kategori</th>
                            <th style="padding: 12px; text-align: center;">Sisa Stok</th>
                            <th style="padding: 12px; text-align: center;">Status Indikator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporanStok as $stok)
                        <tr style="border-bottom: 1px solid #ddd; background: {{ $stok->stok <= 5 ? '#fff5f5' : 'white' }};">
                            <td style="padding: 12px; font-weight: bold;">{{ $stok->kode_produk }}</td>
                            <td style="padding: 12px;">{{ $stok->nama_produk }}</td>
                            <td style="padding: 12px; text-transform: capitalize;">{{ $stok->kategori }}</td>
                            <td style="padding: 12px; text-align: center; font-weight: bold; font-size: 1.1rem; color: {{ $stok->stok <= 5 ? '#DC3545' : '#16A34A' }};">
                                {{ $stok->stok }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                @if($stok->stok == 0)
                                    <span style="background: #DC3545; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; white-space: nowrap;">Habis Total!</span>
                                @elseif($stok->stok <= 5)
                                    <span style="background: #ffc107; color: #333; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; white-space: nowrap;">Segera Restock</span>
                                @else
                                    <span style="background: #16A34A; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; white-space: nowrap;">Aman</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 12px; padding: 20px;">
                <h4 style="margin-top: 0; color: #666; margin-bottom: 15px; text-align: center;">Sisa Stok Semua Produk</h4>
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="stokChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .tabs-header::-webkit-scrollbar { display: none; }
    .tabs-header { -ms-overflow-style: none; scrollbar-width: none; }

    .tab-btn {
        background: transparent; border: none; padding: 12px 25px;
        font-size: 1rem; font-weight: 600; color: #888;
        cursor: pointer; border-bottom: 3px solid transparent;
        transition: 0.3s; font-family: inherit;
    }
    .tab-btn:hover { color: var(--secondary-color); background-color: rgba(0,0,0,0.02); }
    .tab-btn.active { color: var(--primary-color); border-bottom: 3px solid var(--primary-color); background-color: rgba(0,0,0,0.02); }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ================= CSS RESPONSIVE KHUSUS LAPORAN ================= */
    @media (max-width: 850px) {
        /* 1. Header dan Form Filter menumpuk vertikal */
        .dashboard-welcome {
            flex-direction: column;
            align-items: stretch !important;
        }
        .dashboard-welcome .welcome-text {
            text-align: center;
            margin-bottom: 10px;
        }
        .form-filter-laporan {
            flex-direction: column !important;
            align-items: stretch !important;
            width: 100% !important;
            box-sizing: border-box;
        }
        .form-filter-laporan > div {
            width: 100% !important;
        }
        .form-filter-laporan input {
            width: 100% !important;
            box-sizing: border-box;
        }
        .form-filter-laporan .filter-actions {
            flex-direction: column !important;
        }
        .form-filter-laporan .filter-actions button,
        .form-filter-laporan .filter-actions a {
            width: 100% !important;
            box-sizing: border-box;
        }

        /* 2. Ringkasan Keuangan Card memenuhi layar HP */
        .card-keuangan {
            width: 100% !important;
            box-sizing: border-box;
            text-align: center;
        }

        /* 3. Rapikan sub-header tab agar tidak berdesakan */
        .header-tab-title {
            flex-direction: column;
            text-align: center;
            align-items: center !important;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Logika Pindah Tab
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tab-btn");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // --- INISIALISASI GRAFIK CHART.JS ---
    document.addEventListener("DOMContentLoaded", function() {

        if (document.documentElement.classList.contains('dark')) {
            Chart.defaults.color = '#9ca3af'; // Mengubah teks label menjadi abu-abu terang
            Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.1)'; // Memunculkan garis grid tipis berwarna putih
        }

        // 1. Grafik Garis (Line Chart) - Pendapatan Harian
        new Chart(document.getElementById('penjualanChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($grafikPendapatan)) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode(array_values($grafikPendapatan)) !!},
                    borderColor: '#5A3E36', // Warna Coklat Cakeys
                    backgroundColor: 'rgba(90, 62, 54, 0.2)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3 // Melengkung mulus
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // 2. Grafik Batang (Bar Chart) - Jumlah Transaksi
        new Chart(document.getElementById('keuanganChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($grafikTransaksi)) !!},
                datasets: [{
                    label: 'Jumlah Transaksi Sukses',
                    data: {!! json_encode(array_values($grafikTransaksi)) !!},
                    backgroundColor: '#D97706', // Warna Oranye/Gold
                    borderRadius: 5
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // 3. Grafik Donut - Performa Produk
        new Chart(document.getElementById('performaChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($perfLabels) !!},
                datasets: [{
                    data: {!! json_encode($perfData) !!},
                    backgroundColor: ['#5A3E36', '#D97706', '#16A34A', '#2563EB', '#DC3545'],
                    hoverOffset: 10
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // 4. Grafik Batang (Bar Chart) - Sisa Stok
        new Chart(document.getElementById('stokChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($stokLabels) !!},
                datasets: [{
                    label: 'Sisa Stok (Pcs)',
                    data: {!! json_encode($stokData) !!},
                    backgroundColor: {!! json_encode($stokColors) !!},
                    borderRadius: 4
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

    });
</script>
@endsection
