<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cakeys - Create Your Own Cake')</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
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
        <div class="nav-kiri">
            <img src="{{ asset('images/opsi-logo-2.png') }}" alt="logo" class="logo">
            <div class="nav-teks">
                <h1>CAKEYS</h1>
                <p>Create Your Own Cake</p>
            </div>
        </div>

        <ul class="nav-menu">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/katalog') }}">Katalog</a></li>
            <li><a href="{{ url('/tentang') }}">Tentang</a></li>
            <li><a href="{{ url('/kontak') }}">Kontak</a></li>
            <li><a href="{{ route('preferensi') }}">Preferensi</a></li>
        </ul>

        <div class="nav-icon">
            <button type="button" id="themeToggle" style="background: none; border: none; cursor: pointer; font-size: 1.2rem; color: white;">
                <span id="theme-icon">🌙</span>
            </button>

            <span class="icon bitcoin-icons--search-outline"></span>

            <div class="cart-icon" style="position: relative; cursor: pointer; margin-right: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#fff" d="M16 18a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1a1 1 0 0 0 1 1a1 1 0 0 0 1-1a1 1 0 0 0-1-1m-9-1a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1a1 1 0 0 0 1 1a1 1 0 0 0 1-1a1 1 0 0 0-1-1M18 6H4.27l2.55 6H15c.33 0 .62-.16.8-.4l3-4c.13-.17.2-.38.2-.6a1 1 0 0 0-1-1m-3 7H6.87l-.77 1.56L6 15a1 1 0 0 0 1 1h11v1H7a2 2 0 0 1-2-2a2 2 0 0 1 .25-.97l.72-1.47L2.34 4H1V3h2l.85 2H18a2 2 0 0 1 2 2c0 .5-.17.92-.45 1.26l-2.91 3.89c-.36.51-.96.85-1.64.85"/></svg>
                <span style="position: absolute; top: -5px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.7rem;">0</span>
            </div>

            @auth
                <div class="profile-container" id="profileContainer" style="display: flex; align-items: center; gap: 12px;">
                    <span style="color: white; font-weight: 600; font-size: 1rem; cursor: default;">
                        Halo, {{ Auth::user()->name }}!
                    </span>
                    <span class="icon healthicons--ui-user-profile" id="profileBtn"></span>

                    <div class="dropdown" id="profileDropdown">
                        <p><strong>{{ Auth::user()->name }}</strong></p>
                        <hr style="margin: 5px 0; border: 0; border-top: 1px solid #ddd;">
                        <p><a href="{{ route('dashboard') }}" style="color: inherit; text-decoration: none;">Dashboard Owner</a></p>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;">
                            @csrf
                            <button type="submit" style="background: none; border: none; padding: 0; font-family: inherit; font-size: 0.9rem; color: inherit; cursor: pointer; width: 100%; text-align: left; margin: 8px 0;">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="icon healthicons--ui-user-profile" style="color: inherit; text-decoration: none;"></a>
            @endauth
        </div>
    </nav>

    <main class="main-content" style="padding-top: 90px; padding-left: 0; padding-right: 0;">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="{{ asset('images/opsi-logo-2.png') }}" alt="Logo Cakeys">
                    <div>
                        <h2>CAKEYS</h2>
                        <p style="color: var(--accent-color); font-size: 0.9rem;">Create Your Own Cake</p>
                    </div>
                </div>
                <p>Toko kue custom untuk berbagai acara. Nikmati acara dengan kue spesial sesuai keinginanmu! 🎂</p>
            </div>

            <div class="footer-center">
                <h3>Menu</h3>
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/katalog') }}">Katalog</a></li>
                    <li><a href="{{ url('/tentang') }}">Tentang</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
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
    </script>

    <script>
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

        function deleteCookie(name) {
            document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        const themeCookie = getCookie('theme');
        const iconSpan = document.getElementById('theme-icon');

        if (themeCookie === 'dark') {
            document.documentElement.classList.add('dark');
            iconSpan.innerText = '☀️';
        } else {
            document.documentElement.classList.remove('dark');
            iconSpan.innerText = '🌙';
        }

        document.getElementById('themeToggle').addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            if (document.documentElement.classList.contains('dark')) {
                setCookie('theme', 'dark', 7);
                iconSpan.innerText = '☀️';
            } else {
                setCookie('theme', 'light', 7);
                iconSpan.innerText = '🌙';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
