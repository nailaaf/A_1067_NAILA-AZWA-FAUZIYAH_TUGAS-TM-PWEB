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
            <h2>Menu Owner</h2>
            <button type="button" id="closeMenuBtn">&times;</button>
        </div>
        <ul class="nav-menu">
            <li class="mobile-only-menu" style="border-bottom: 1px solid var(--border-color, #EFE8DF); padding-bottom: 15px; margin-bottom: 15px;">
                <div style="display: flex; align-items: center; gap: 10px; padding: 5px 10px;">
                    <span class="icon healthicons--ui-user-profile" style="color: var(--primary-color);"></span>
                    <span style="font-weight: bold; color: var(--primary-color); font-size: 1.1rem;">{{ Auth::user()->name }}</span>
                </div>
            </li>

            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('produk.index') }}">Produk</a></li>
            <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
            <li><a href="{{ route('laporan.index') }}">Laporan</a></li>
            <li><a href="{{ route('profile.index') }}">Profile</a></li>

            <li class="mobile-only-menu" style="margin-top: 15px; border-top: 1px solid var(--border-color, #EFE8DF); padding-top: 15px;">
                {{-- <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #DC3545; font-size: 1.1rem; font-weight: bold; font-family: inherit; cursor: pointer; padding: 5px 10px; width: 100%; text-align: left;">Logout</button>
                </form> --}}
                <button type="button" onclick="openGlobalLogoutModal()" style="background: none; border: none; color: #DC3545; font-size: 1.1rem; font-weight: bold; font-family: inherit; cursor: pointer; padding: 5px 10px; width: 100%; text-align: left;">Logout</button>
            </li>
        </ul>
    </div>
    <div class="nav-icon">
        <button type="button" id="themeToggle" style="background: none; border: none; cursor: pointer; font-size: 1.2rem; color: white;">
            <span id="theme-icon">🌙</span>
        </button>

        <div class="search-container" id="searchContainer">
            <span class="icon bitcoin-icons--search-outline" onclick="openGlobalSearch()" style="cursor: pointer; transition: 0.3s;" title="Cari Data"></span>
            <form class="search-box" id="searchBox" action="{{ route('produk.index') }}" method="GET">
                <input type="text" name="search" id="searchInput" placeholder="Cari nama produk...">
            </form>
        </div>

        <div class="profile-container" id="profileContainer" style="display: flex; align-items: center; gap: 12px;">
            <span class="nama-user-desktop" style="color: white; font-weight: 600; font-size: 1rem; cursor: default;">
                Halo, {{ Auth::user()->name }}!
            </span>
            <span class="icon healthicons--ui-user-profile" id="profileBtn" style="cursor: pointer;"></span>

            <div class="dropdown" id="profileDropdown">
                <p><strong>Halo, {{ Auth::user()->name }}!</strong></p>
                <hr style="margin: 5px 0; border: 0; border-top: 1px solid #ddd;">
                <p><a href="{{ route('profile.index') }}" style="color: inherit; text-decoration: none;">Profil Saya</a></p>
                <p><a href="{{ route('owner.preferensi') }}" style="color: inherit; text-decoration: none;">Preferensi</a></p>

                {{-- <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; padding: 0; font-family: inherit; font-size: 0.9rem; color: inherit; cursor: pointer; width: 100%; text-align: left; margin: 8px 0;">
                        Logout
                    </button>
                </form> --}}
                <button type="button" onclick="openGlobalLogoutModal()" style="background: none; border: none; padding: 0; font-family: inherit; font-size: 0.9rem; color: inherit; cursor: pointer; width: 100%; text-align: left; margin: 8px 0;">Logout</button>
            </div>
        </div>

        <span class="icon" id="hamburgerBtn" style="display: none; cursor: pointer; margin-left: 5px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#fff" d="M3 18v-2h18v2zm0-5v-2h18v2zm0-5V6h18v2z"/></svg>
        </span>
    </div>
</nav>

<div id="globalLogoutModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 999999; justify-content: center; align-items: center; animation: fadeIn 0.3s forwards;">
    <div style="background-color: var(--surface-color); padding: 40px; border-radius: 15px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid var(--border-color); transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">

        <h2 style="color: var(--primary-color); margin-bottom: 15px;">Yakin Ingin Keluar?</h2>
        <p style="color: var(--text-color); margin-bottom: 30px; font-size: 0.95rem;">Kamu harus login kembali untuk masuk ke Dashboard Cakeys.</p>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <button type="button" onclick="closeGlobalLogoutModal()" style="padding: 12px 25px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--background-color); color: var(--text-color); font-family: inherit; cursor: pointer; font-weight: bold; transition: 0.2s;" onmouseover="this.style.backgroundColor='var(--surface-color)'" onmouseout="this.style.backgroundColor='var(--background-color)'">Batal</button>

            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" style="padding: 12px 25px; border-radius: 8px; background-color: #DC3545; color: white; border: none; font-family: inherit; font-weight: bold; cursor: pointer; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); transition: 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Ya, Logout</button>
            </form>
        </div>

    </div>
</div>

<script>
    function openGlobalLogoutModal() {
        // Otomatis menutup dropdown/menu samping jika sedang terbuka
        const profileDropdown = document.getElementById('profileDropdown');
        if (profileDropdown) profileDropdown.classList.remove('active');

        const navOverlay = document.getElementById('navOverlay');
        if (navOverlay) navOverlay.classList.remove('active');

        // Munculkan Modalnya
        document.getElementById('globalLogoutModal').style.display = 'flex';
    }

    function closeGlobalLogoutModal() {
        document.getElementById('globalLogoutModal').style.display = 'none';
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. Logika Dropdown Profile (Desktop) ---
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
            profileDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // --- 2. Logika Dark/Light Mode ---
        const themeToggle = document.getElementById('themeToggle');
        const iconSpan = document.getElementById('theme-icon');

        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/; SameSite=Lax";
        }

        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for(let i=0;i < ca.length;i++) {
                let c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        if (document.documentElement.classList.contains('dark') || getCookie('theme') === 'dark') {
            if(iconSpan) iconSpan.textContent = '☀️';
        } else {
            if(iconSpan) iconSpan.textContent = '🌙';
        }

        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            if (document.documentElement.classList.contains('dark')) {
                setCookie('theme', 'dark', 7);
                if(iconSpan) iconSpan.textContent = '☀️';
            } else {
                setCookie('theme', 'light', 7);
                if(iconSpan) iconSpan.textContent = '🌙';
            }

            // --- 3. Logika Animasi Search Box ---
            const searchBtn = document.getElementById('searchBtn');
            const searchBox = document.getElementById('searchBox');
            const searchContainer = document.getElementById('searchContainer');
            const searchInput = document.getElementById('searchInput');

            if (searchBtn && searchBox) {
                // Munculkan/Sembunyikan kotak saat ikon diklik
                searchBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    searchBox.classList.toggle('active');

                    // Otomatis kursor masuk ke inputan saat terbuka
                    if (searchBox.classList.contains('active')) {
                        searchInput.focus();
                    }
                });

                // Tutup kotak pencarian kalau user klik di sembarang tempat
                document.addEventListener('click', function(e) {
                    if (!searchContainer.contains(e.target)) {
                        searchBox.classList.remove('active');
                    }
                });
            }
        });
    });
</script>
