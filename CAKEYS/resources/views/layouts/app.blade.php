<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Cakeys - Dashboard Owner')</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        (function() {
            var ca = document.cookie.split(';');
            var theme = 'light';
            var fontSize = 'medium';

            for(var i=0; i < ca.length; i++) {
                var c = ca[i].trim();
                if (c.indexOf("theme=") == 0) theme = c.substring(6, c.length);
                if (c.indexOf("font_size=") == 0) fontSize = c.substring(10, c.length);
            }

            // Langsung pasang class dark jika cookie theme=dark
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            // Langsung pasang class font-size dari cookie
            document.documentElement.classList.add('font-' + fontSize);
        })();
    </script>
</head>
<body>
    <div class="menu-overlay" id="menuOverlay"></div>

    @include('partials.navbar')

    @if(session('success'))
        <div id="flash-message-success" style="position: fixed; top: 90px; right: 20px; background-color: #f4e8e1; color: #5A3E36; padding: 15px 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 9999; font-weight: 600; border-left: 5px solid #5A3E36; transition: opacity 0.5s ease;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="flash-message-error" style="position: fixed; top: 90px; right: 20px; background-color: #fde8e8; color: #9b1c1c; padding: 15px 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 9999; font-weight: 600; border-left: 5px solid #9b1c1c; transition: opacity 0.5s ease;">
            {{ session('error') }}
        </div>
    @endif

    <script>
        // Logika menghilangkan flash message otomatis
        setTimeout(function() {
            let flashSuccess = document.getElementById('flash-message-success');
            if(flashSuccess) {
                flashSuccess.style.opacity = '0';
                setTimeout(() => flashSuccess.remove(), 500);
            }

            let flashError = document.getElementById('flash-message-error');
            if(flashError) {
                flashError.style.opacity = '0';
                setTimeout(() => flashError.remove(), 500);
            }
        }, 3000);
    </script>

    <style>
        /* 1. Paksa elemen terang menjadi gelap */
        html.dark [style*="background: white"],
        html.dark [style*="background-color: white"],
        html.dark [style*="background: #fffaf0"],
        html.dark [style*="background-color: #fffaf0"],
        html.dark [style*="background: #f9f9f9"],
        html.dark [style*="background-color: #f9f9f9"] {
            background-color: var(--surface-color) !important;
            color: var(--text-color) !important;
        }

        /* 2. Header tabel */
        html.dark [style*="background-color: #f4e8e1"],
        html.dark [style*="background: #f4e8e1"],
        html.dark .table-order thead {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
        }

        /* 3. Teks gelap menjadi terang (KECUALI tombol kuning) */
        html.dark [style*="color: #333"]:not(button):not(a),
        html.dark [style*="color: #555"]:not(button):not(a),
        html.dark [style*="color: #666"]:not(button):not(a) {
            color: #d1d5db !important;
        }

        /* 4. Fix tombol kuning (Simpan & Edit) agar teksnya tetap gelap/hitam */
        html.dark button[style*="background-color: #ffc107"],
        html.dark a[style*="background-color: #ffc107"] {
            color: #453002 !important;
        }

        /* 5. Fix warna background baris stok menipis (Merah muda -> Merah gelap transparan) */
        html.dark [style*="background: #fff5f5"] {
            background-color: rgba(220, 53, 69, 0.15) !important;
        }

        /* 6. Fix garis border */
        html.dark [style*="border: 1px solid #ddd"],
        html.dark [style*="border-bottom: 1px solid #ddd"],
        html.dark [style*="border-bottom: 1px solid #eee"],
        html.dark [style*="border: 2px dashed #ccc"],
        html.dark [style*="border: 2px dashed #ddd"],
        html.dark [style*="border-bottom: 2px solid #EFE8DF"] {
            border-color: #374151 !important;
        }

        /* 7. Fix kolom inputan dan Opsi Dropdown */
        html.dark input, html.dark select, html.dark textarea {
            background-color: var(--background-color) !important;
            color: var(--text-color) !important;
            border-color: #374151 !important;
        }

        /* Memaksa list opsi dropdown menjadi gelap secara mutlak */
        html.dark option {
            background-color: #222222 !important;
            color: #dddddd !important;
        }

        /* 8. FIX HOVER PUTIH JELEK DI TABEL & TAB LAPORAN */
        html.dark .table-order tbody tr:hover,
        html.dark tr[onmouseover]:hover,
        html.dark .tab-btn:hover,
        html.dark .tab-btn.active {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
    </style>

    <main class="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    <div id="globalSearchModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 99999; justify-content: center; align-items: flex-start; padding-top: 15vh; animation: fadeIn 0.3s forwards;">
        <div style="width: 90%; max-width: 700px; position: relative; animation: slideDown 0.4s ease-out forwards;">

            <button onclick="closeGlobalSearch()" style="position: absolute; right: 0; top: -50px; background: none; border: none; color: white; font-size: 2.5rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='var(--primary-color)'" onmouseout="this.style.color='white'">&times;</button>

            <form id="globalSearchForm" action="{{ route('produk.index') }}" method="GET" style="display: flex; width: 100%; background: var(--surface-color); border-radius: 50px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.5); border: 2px solid var(--primary-color);">

                <span style="padding: 20px 25px; font-size: 1.5rem; display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 48 48">
                        <path d="M0 0h48v48H0z" fill="none" />
                        <defs>
                            <mask id="SVGzmt0MemV">
                                <g fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="4">
                                    <path fill="#555" d="M21 38c9.389 0 17-7.611 17-17S30.389 4 21 4S4 11.611 4 21s7.611 17 17 17Z" />
                                    <path stroke-linecap="round" d="M26.657 14.343A7.98 7.98 0 0 0 21 12a7.98 7.98 0 0 0-5.657 2.343m17.879 18.879l8.485 8.485" />
                                </g>
                            </mask>
                        </defs>
                        <path fill="var(--primary-color)" d="M0 0h48v48H0z" mask="url(#SVGzmt0MemV)" />
                    </svg>
                </span>

                <input type="text" name="search" id="globalSearchInput" placeholder="Cari data produk..." style="flex: 1; border: none; background: transparent; color: var(--text-color); font-size: 1.2rem; font-family: inherit; outline: none; padding-right: 25px;">
                <button type="submit" style="padding: 0 35px; background-color: var(--primary-color); color: white; border: none; font-weight: bold; font-family: inherit; cursor: pointer; font-size: 1rem; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Cari</button>
            </form>
        </div>
    </div>

    <style>
        @keyframes fadeIn { to { opacity: 1; } }
        @keyframes slideDown { from { transform: translateY(-30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    </style>

    <script>
        function openGlobalSearch() {
            document.getElementById('globalSearchModal').style.display = 'flex';
            setTimeout(() => document.getElementById('globalSearchInput').focus(), 100);
        }

        function closeGlobalSearch() {
            document.getElementById('globalSearchModal').style.display = 'none';
            document.getElementById('globalSearchInput').value = '';
        }

        document.getElementById('globalSearchModal').addEventListener('click', function(e) {
            if (e.target === this) closeGlobalSearch();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeGlobalSearch();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const navOverlay = document.getElementById('navOverlay');
            const closeMenuBtn = document.getElementById('closeMenuBtn');

            function toggleMenu() {
                if(navOverlay) {
                    navOverlay.classList.toggle('active');

                    // Mencegah layar utama bisa di-scroll saat menu terbuka
                    if (navOverlay.classList.contains('active')) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = 'auto';
                    }
                }
            }

            if(hamburgerBtn) hamburgerBtn.addEventListener('click', toggleMenu);
            if(closeMenuBtn) closeMenuBtn.addEventListener('click', toggleMenu);
        });
    </script>
    @stack('scripts')
</body>
</html>
