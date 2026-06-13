@extends('layouts.customer')

@section('title', 'Katalog - Cakeys')

@section('content')
{{-- <div class="dashboard-wrapper" style="padding: 40px 5%;">
    <div class="dashboard-welcome">
        <h3>Pilih Kue Favoritmu</h3>
        <h1>Katalog Cakeys</h1>
    </div>

    <div class="top-bar">
        <input type="text" id="search" placeholder="Cari nama produk...">

        <div class="katalog-filter">
            <ul class="filter-list">
                <li class="active">Semua Kategori</li>
                @foreach($kategori as $k)
                    <li style="text-transform: capitalize;">{{ ucfirst($k) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="produk-grid" id="product-grid">
        @foreach ($produk as $p)
        <div class="produk-card">
            <div class="card-image">
                <img src="{{ asset($p->gambar) }}" alt="{{ $p->nama_produk }}">
                <span class="badge-kategori">{{ ucfirst($p->kategori) }}</span>
            </div>

            <div class="card-details">
                <h3 class="kue-nama" style="margin-top: 10px;">{{ $p->nama_produk }}</h3>
                <p class="kue-harga">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>

                <div class="kue-stok">
                    @if($p->stok <= 5)
                        <span class="stok-warning">Sisa Stok: {{ $p->stok }}</span>
                    @else
                        <span class="stok-aman">Stok Tersedia</span>
                    @endif
                </div>

                <div class="card-actions" style="margin-top: 15px;">
                    <button style="width: 100%; padding: 10px; background-color: var(--primary-color); color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='var(--secondary-color)'" onmouseout="this.style.backgroundColor='var(--primary-color)'">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div> --}}

<div class="dashboard-wrapper" style="padding: 40px 5%;">
    <div class="dashboard-welcome">
        <h3>Pilih Kue Favoritmu</h3>
        <h1>Katalog Cakeys</h1>
    </div>

    <div class="top-bar">
        <input type="text" id="search" placeholder="Cari nama produk...">

        <div class="katalog-filter">
            <ul class="filter-list">
                <li class="active">Semua Kategori</li>
                @foreach($kategori as $k)
                    <li style="text-transform: capitalize;">{{ ucfirst($k) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="produk-grid" id="product-grid">
        @foreach ($produk as $p)
        <div class="produk-card">
            <div class="card-image">
                <img src="{{ asset($p->gambar) }}" alt="{{ $p->nama_produk }}" onclick="window.location.href='{{ route('katalog.show', $p->id) }}'" style="cursor: pointer;">
                <span class="badge-kategori">{{ ucfirst($p->kategori) }}</span>
            </div>

            <div class="card-details">
                <h3 class="kue-nama" style="margin-top: 10px; cursor: pointer;" onclick="window.location.href='{{ route('katalog.show', $p->id) }}'">{{ $p->nama_produk }}</h3>
                <p class="kue-harga">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>

                <div class="kue-stok">
                    @if($p->stok <= 5)
                        <span class="stok-warning">Sisa Stok: {{ $p->stok }}</span>
                    @else
                        <span class="stok-aman">Stok Tersedia</span>
                    @endif
                </div>

                <div class="card-actions" style="margin-top: 15px;">
                    <form action="{{ route('keranjang.tambah') }}" method="POST" style="width: 100%; margin: 0;">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $p->id }}">
                        <input type="hidden" name="jumlah" value="1">
                        <input type="hidden" name="addon" value="0">
                        <input type="hidden" name="catatan" value="-">

                        <button type="submit" style="width: 100%; padding: 10px; background-color: var(--primary-color); color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='var(--secondary-color)'" onmouseout="this.style.backgroundColor='var(--primary-color)'">
                            Tambah ke Keranjang
                        </button>
                    </form>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('search');
        const productGrid = document.getElementById('product-grid');
        const filterItems = document.querySelectorAll('.filter-list li');

        const originalHTML = productGrid.innerHTML;
        let searchTimeout;
        let fetchController;

        // --- TAMBAHAN BARU: Menangkap kata kunci dari Global Search Navbar ---
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('search')) {
            searchInput.value = urlParams.get('search'); // Isi otomatis ke input
            setTimeout(loadProducts, 100); // Langsung filter otomatis

            // Hapus "?search=" dari URL agar terlihat bersih setelah difilter (Opsional)
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        // ---------------------------------------------------------------------

        function loadProducts() {
            const keyword = searchInput.value.trim();

            const activeCategoryElement = document.querySelector('.filter-list li.active');
            const activeCategory = activeCategoryElement ? activeCategoryElement.innerText.trim() : 'Semua Kategori';

            clearTimeout(searchTimeout);

            if (fetchController) {
                fetchController.abort();
            }

            if (keyword === '' && activeCategory.toLowerCase() === 'semua kategori') {
                productGrid.innerHTML = originalHTML;
                return;
            }

            productGrid.innerHTML = '<p style="grid-column: 1 / -1; text-align: center; color: var(--secondary-color); padding: 40px; font-weight: bold;">⏳ Memuat produk...</p>';

            searchTimeout = setTimeout(async function() {
                fetchController = new AbortController();
                const signal = fetchController.signal;

                try {
                    const response = await fetch(`/katalog/search?keyword=${encodeURIComponent(keyword)}&kategori=${encodeURIComponent(activeCategory)}`, {
                        signal: signal,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error('Gagal mengambil data');
                    const produks = await response.json();

                    if (searchInput.value.trim() !== keyword) return;

                    let newHTML = '';

                    if (produks.length === 0) {
                        newHTML = '<p style="grid-column: 1 / -1; text-align: center; color: var(--secondary-color); padding: 40px;">Maaf, produk tidak ditemukan di kategori ini.</p>';
                    } else {
                        produks.forEach(p => {
                            const hargaFormatted = new Intl.NumberFormat('id-ID').format(p.harga);
                            const kategoriFormatted = p.kategori.charAt(0).toUpperCase() + p.kategori.slice(1);
                            let stokMessage = p.stok <= 5
                                ? `<span class="stok-warning">Sisa Stok: ${p.stok}</span>`
                                : `<span class="stok-aman">Stok Tersedia</span>`;

                            newHTML += `
                                <div class="produk-card">
                                    <div class="card-image">
                                        <img src="/${p.gambar}" alt="${p.nama_produk}">
                                        <span class="badge-kategori">${kategoriFormatted}</span>
                                    </div>
                                    <div class="card-details">
                                        <h3 class="kue-nama" style="margin-top: 10px;">${p.nama_produk}</h3>
                                        <p class="kue-harga">Rp ${hargaFormatted}</p>
                                        <div class="kue-stok">${stokMessage}</div>
                                        <div class="card-actions" style="margin-top: 15px;">
                                            <form action="/keranjang/tambah" method="POST" style="width: 100%; margin: 0;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="produk_id" value="${p.id}">
                                                <input type="hidden" name="jumlah" value="1">
                                                <input type="hidden" name="addon" value="0">
                                                <input type="hidden" name="catatan" value="-">

                                                <button type="submit" style="width: 100%; padding: 10px; background-color: var(--primary-color); color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='var(--secondary-color)'" onmouseout="this.style.backgroundColor='var(--primary-color)'">
                                                    Tambah ke Keranjang
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    }

                    productGrid.innerHTML = newHTML;

                } catch (error) {
                    if (error.name === 'AbortError') {
                        console.log('Pencarian dibatalkan.');
                    } else {
                        console.error("Error saat pencarian:", error);
                    }
                }
            }, 100);
        }

        searchInput.addEventListener('input', loadProducts);

        filterItems.forEach(item => {
            item.addEventListener('click', function() {
                filterItems.forEach(li => li.classList.remove('active'));
                this.classList.add('active');

                loadProducts();
            });
        });
    });
</script>
@endpush
