<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cakeys - Create Your Own Cake')</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            document.documentElement.classList.add('font-' + fontSize);
        })();
    </script>
</head>
<body>
    <nav class="navbar">
        <div class="nav-kiri" style="display: flex; align-items: center; gap: 12px; height: 100%;">
            <img src="{{ asset('images/opsi-logo-2-baru.png') }}" alt="logo" class="logo" style="height: 55px; width: auto; object-fit: contain;">
            <div class="nav-teks" style="display: flex; flex-direction: column; justify-content: center;">
                <h1 style="margin: 0; font-size: 1.6rem; font-weight: 700; line-height: 1.1; letter-spacing: 1.5px; color: #FFFFFF;">CAKEYS</h1>
                <p class="slogan-desktop" style="margin: 0; font-size: 0.85rem; font-weight: 500; color: var(--accent-color);">Create Your Own Cake</p>
            </div>
        </div>

        <div class="nav-overlay" id="navOverlay">
            <div class="menu-header-mobile">
                <h2>Menu</h2>
                <button type="button" id="closeMenuBtn">&times;</button>
            </div>
            <ul class="nav-menu">

                <li class="mobile-only-menu" style="border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 15px;">
                    @guest
                        <a href="{{ route('login') }}" style="background-color: var(--primary-color); color: white; text-align: center; border-radius: 8px; padding: 10px; font-weight: bold; display: block;">Masuk / Login</a>
                    @else
                        <div style="display: flex; align-items: center; gap: 10px; padding: 10px;">
                            <span class="icon healthicons--ui-user-profile" style="color: var(--primary-color);"></span>
                            <span style="font-weight: bold; color: var(--primary-color); font-size: 1.1rem;">{{ Auth::user()->name }}</span>
                        </div>
                    @endguest
                </li>

                @guest
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/katalog') }}">Katalog</a></li>
                    <li><a href="{{ route('cek-pesanan') }}">Cek Pesanan</a></li>
                    <li><a href="{{ url('/tentang') }}">Tentang</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                    <li><a href="{{ route('preferensi') }}">Preferensi</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('produk.index') }}">Produk</a></li>
                    <li><a href="{{ url('/pesanan') }}">Pesanan</a></li>
                    <li><a href="{{ url('/laporan') }}">Laporan</a></li>

                    <li class="mobile-only-menu" style="margin-top: 15px; border-top: 1px solid var(--border-color); padding-top: 15px;">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: #DC3545; font-size: 1.1rem; font-weight: bold; font-family: inherit; cursor: pointer;">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
        <div class="nav-icon">
            <button type="button" id="themeToggle" style="background: none; border: none; cursor: pointer; font-size: 1.2rem; color: white;">
                <span id="theme-icon">🌙</span>
            </button>

            @guest
                <span class="icon bitcoin-icons--search-outline" onclick="openGlobalSearch()" style="cursor: pointer; transition: 0.3s;" title="Cari Kue" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'"></span>

                <a href="{{ route('keranjang.index') }}" style="text-decoration: none;">
                    <div class="cart-icon" style="position: relative; cursor: pointer; margin-right: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"><path fill="#fff" d="M16 18a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1a1 1 0 0 0 1 1a1 1 0 0 0 1-1a1 1 0 0 0-1-1m-9-1a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1a1 1 0 0 0 1 1a1 1 0 0 0 1-1a1 1 0 0 0-1-1M18 6H4.27l2.55 6H15c.33 0 .62-.16.8-.4l3-4c.13-.17.2-.38.2-.6a1 1 0 0 0-1-1m-3 7H6.87l-.77 1.56L6 15a1 1 0 0 0 1 1h11v1H7a2 2 0 0 1-2-2a2 2 0 0 1 .25-.97l.72-1.47L2.34 4H1V3h2l.85 2H18a2 2 0 0 1 2 2c0 .5-.17.92-.45 1.26l-2.91 3.89c-.36.51-.96.85-1.64.85"/></svg>
                        @php $jumlahKeranjang = session('keranjang') ? count(session('keranjang')) : 0; @endphp
                        <span style="position: absolute; top: -5px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.7rem; font-weight: bold;">
                            {{ $jumlahKeranjang }}
                        </span>
                    </div>
                </a>

                <a href="{{ route('login') }}" class="btn-login-nav" style="background-color: #E8C39E; color: #3E2415; padding: 6px 20px; border-radius: 20px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: 0.3s; margin-left: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.15);">Login</a>
            @else
                <div class="profile-container" id="profileContainer" style="display: flex; align-items: center; gap: 12px;">
                    <span class="nama-user-desktop" style="color: white; font-weight: 600; font-size: 1rem; cursor: default;">
                        Halo, {{ Auth::user()->name }}!
                    </span>
                    <span class="icon healthicons--ui-user-profile" id="profileBtn"></span>

                    <div class="dropdown" id="profileDropdown">
                        <p><strong>{{ Auth::user()->name }}</strong></p>
                        <hr style="margin: 5px 0; border: 0; border-top: 1px solid #ddd;">
                        <p><a href="{{ route('profile.edit') }}" style="color: inherit; text-decoration: none;">Profil Saya</a></p>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;">
                            @csrf
                            <button type="submit" style="background: none; border: none; padding: 0; font-family: inherit; font-size: 0.9rem; color: inherit; cursor: pointer; width: 100%; text-align: left; margin: 8px 0;">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth

            <span class="icon" id="hamburgerBtn" style="display: none; cursor: pointer; margin-left: 5px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#fff" d="M3 18v-2h18v2zm0-5v-2h18v2zm0-5V6h18v2z"/></svg>
            </span>
        </div>
    </nav>

    <main class="main-content" style="padding-top: 90px; padding-left: 0; padding-right: 0;">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="{{ asset('images/opsi-logo-2-baru.png') }}" alt="Logo Cakeys">
                    <div>
                        <h2>CAKEYS</h2>
                        <p style="color: var(--accent-color); font-size: 0.9rem;">Create Your Own Cake</p>
                    </div>
                </div>
                <p>Toko kue custom untuk berbagai acara. Nikmati acara dengan kue spesial sesuai keinginanmu!</p>
            </div>

            <div class="footer-center">
                <h3>Menu</h3>
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/katalog') }}">Katalog</a></li>
                    <li><a href="{{ route('cek-pesanan') }}">Cek Pesanan</a></li>
                    <li><a href="{{ url('/tentang') }}">Tentang</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                    <li><a href="{{ route('preferensi') }}">Preferensi</a></li>
                </ul>
            </div>

            <div>
                <h3 style="color: var(--accent-color); margin-bottom: 15px;">Hubungi Kami</h3>
                <p>📍 Alamat: Jember, Jawa Timur</p>
                <p>📞 Telp: 0812-3456-7890</p>
                <p>📷 Instagram: @cakeyscake</p>
                <p>✉️ Email: cakeys@gmail.com</p>
            </div>
        </div>

        <div style="text-align: center; color: #bbb; font-size: 0.9rem;">
            <p>© 2026 Cakeys | Naila's Project</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileBtn = document.getElementById('profileBtn');
            const profileDropdown = document.getElementById('profileDropdown');
            const profileContainer = document.getElementById('profileContainer');

            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('active');
                });

                document.addEventListener('click', function(e) {
                    if (!profileContainer.contains(e.target)) {
                        profileDropdown.classList.remove('active');
                    }
                });
            }
        });

        // Script Dark Mode Cookie
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
        }

        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for(let i=0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        const themeCookie = getCookie('theme');
        const iconSpan = document.getElementById('theme-icon');

        if (themeCookie === 'dark') {
            document.documentElement.classList.add('dark');
            if(iconSpan) iconSpan.innerText = '☀️';
        } else {
            document.documentElement.classList.remove('dark');
            if(iconSpan) iconSpan.innerText = '🌙';
        }

        document.getElementById('themeToggle').addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            if (document.documentElement.classList.contains('dark')) {
                setCookie('theme', 'dark', 7);
                if(iconSpan) iconSpan.innerText = '☀️';
            } else {
                setCookie('theme', 'light', 7);
                if(iconSpan) iconSpan.innerText = '🌙';
            }
        });
    </script>

    @stack('scripts')

    @if(session('whatsapp_url'))
    <div id="waModal" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; z-index: 99999; opacity: 0; animation: fadeIn 0.3s forwards;">
        <div style="background-color: var(--surface-color); color: var(--text-color); padding: 40px; border-radius: 15px; max-width: 450px; width: 90%; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid var(--primary-color); transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">
            <div style="font-size: 3rem; margin-bottom: 10px;">🎉</div>
            <h2 style="color: var(--primary-color); margin-bottom: 15px; font-weight: bold;">Pesanan Berhasil Dicatat!</h2>
            <p style="margin-bottom: 30px; font-size: 0.95rem; line-height: 1.6;">
                Struk pesananmu sudah tersimpan aman di sistem kami. Klik tombol di bawah ini untuk mengirimkan rincian pesananmu ke WhatsApp Admin Cakeys agar segera diproses!
            </p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button onclick="document.getElementById('waModal').style.display='none'" style="padding: 12px 20px; border-radius: 8px; border: 1px solid #ccc; background: transparent; color: var(--text-color); cursor: pointer; font-weight: bold; transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.05)'" onmouseout="this.style.backgroundColor='transparent'">Nanti Saja</button>
                <a href="{{ session('whatsapp_url') }}" target="_blank" onclick="document.getElementById('waModal').style.display='none'" style="padding: 12px 25px; border-radius: 8px; background-color: #25D366; color: white; text-decoration: none; font-weight: bold; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3); transition: 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Buka WhatsApp 💬</a>
            </div>
        </div>
    </div>
    @endif

    <div id="globalSearchModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 99999; justify-content: center; align-items: flex-start; padding-top: 15vh; animation: fadeIn 0.3s forwards;">
        <div style="width: 90%; max-width: 700px; position: relative; animation: slideDown 0.4s ease-out forwards;">

            <button onclick="closeGlobalSearch()" style="position: absolute; right: 0; top: -50px; background: none; border: none; color: white; font-size: 2.5rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='var(--primary-color)'" onmouseout="this.style.color='white'">&times;</button>

            <form id="globalSearchForm" onsubmit="submitGlobalSearch(event)" style="display: flex; width: 100%; background: var(--surface-color); border-radius: 50px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.5); border: 2px solid var(--primary-color);">
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
                <input type="text" id="globalSearchInput" placeholder="Mau cari kue apa hari ini? Ketik lalu tekan Enter..." style="flex: 1; border: none; background: transparent; color: var(--text-color); font-size: 1.2rem; font-family: inherit; outline: none; padding-right: 25px;">
                <button type="submit" style="padding: 0 35px; background-color: var(--primary-color); color: white; border: none; font-weight: bold; font-family: inherit; cursor: pointer; font-size: 1rem; transition: 0.3s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Cari</button>
            </form>
        </div>
    </div>

    <script>
        function openGlobalSearch() {
            document.getElementById('globalSearchModal').style.display = 'flex';
            setTimeout(() => document.getElementById('globalSearchInput').focus(), 100);
        }

        function closeGlobalSearch() {
            document.getElementById('globalSearchModal').style.display = 'none';
            document.getElementById('globalSearchInput').value = '';
        }

        function submitGlobalSearch(e) {
            e.preventDefault();
            let val = document.getElementById('globalSearchInput').value.trim();
            if(!val) return;

            @auth
                window.location.href = "{{ url('/produk') }}?search=" + encodeURIComponent(val);
            @else
                window.location.href = "{{ url('/katalog') }}?search=" + encodeURIComponent(val);
            @endauth
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
                navOverlay.classList.toggle('active');

                // Mencegah layar utama bisa di-scroll saat menu terbuka
                if (navOverlay.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            }

            if(hamburgerBtn) hamburgerBtn.addEventListener('click', toggleMenu);
            if(closeMenuBtn) closeMenuBtn.addEventListener('click', toggleMenu);
        });
    </script>

    <div class="whatsapp-container">
        <div class="whatsapp-tooltip">Butuh info lebih lanjut? Chat Kami</div>

        <a href="https://wa.me/6281615112608" target="_blank" class="whatsapp-float" aria-label="Chat via WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="whatsapp-icon">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
        </a>
    </div>

    <style>
        @keyframes fadeIn { to { opacity: 1; } }
        @keyframes slideUp { to { transform: translateY(0); } }
        @keyframes slideDown { from { transform: translateY(-30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* ================= CSS FLOATING WHATSAPP BUTTON ================= */
        .whatsapp-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .whatsapp-tooltip {
            background-color: var(--surface-color, white);
            color: var(--text-color, #333);
            padding: 8px 18px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            font-size: 0.9rem;
            font-weight: 600;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            pointer-events: none;
            border: 1px solid var(--border-color, #eee);
        }

        .whatsapp-container:hover .whatsapp-tooltip {
            opacity: 1;
            transform: translateX(0);
        }

        .whatsapp-float {
            width: 60px;
            height: 60px;
            background-color: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            background-color: #20b858;
        }

        .whatsapp-icon {
            width: 35px;
            height: 35px;
            fill: white;
        }

        @media (max-width: 768px) {
            .whatsapp-tooltip { display: none; }
            .whatsapp-container { bottom: 20px; right: 20px; }
            .whatsapp-float { width: 55px; height: 55px; }
            .whatsapp-icon { width: 30px; height: 30px; }
        }
    </style>
</body>
</html>
