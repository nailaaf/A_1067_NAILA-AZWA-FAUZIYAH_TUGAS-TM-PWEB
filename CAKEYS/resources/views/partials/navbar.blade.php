<nav class="navbar">
    <div class="nav-kiri">
        <img src="{{ asset('images/opsi-logo-2.png') }}" alt="logo" class="logo">

        <div class="nav-teks">
            <h1>CAKEYS</h1>
            <p>Create Your Own Cake</p>
        </div>
    </div>

    <ul class="nav-menu">
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('katalog') }}">Katalog</a></li>
        <li><a href="{{ route('pesanan') }}">Pesanan</a></li>
        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
    </ul>

    <div class="nav-icon">
        <div class="search-container" id="searchContainer">
            <span class="icon search-btn bitcoin-icons--search-outline" id="searchBtn"></span>
            <form class="search-box" id="searchBox" onsubmit="event.preventDefault();">
                <input type="text" id="searchInput" placeholder="Cari pesanan/produk...">
            </form>
        </div>

        <div class="profile-container" id="profileContainer" style="display: flex; align-items: center; gap: 12px;">

            <span style="color: white; font-weight: 600; font-size: 1rem; cursor: default;">
                Halo, {{ Auth::user()->name }}!
            </span>

            <span class="icon healthicons--ui-user-profile" id="profileBtn"></span>

            <div class="dropdown" id="profileDropdown">
                <p><strong>Halo, {{ Auth::user()->name }}!</strong></p>
                <hr style="margin: 5px 0; border: 0; border-top: 1px solid #ddd;">
                <p><a href="{{ route('profile.edit') }}" style="color: inherit; text-decoration: none;">Profil Saya</a></p>
                <p>Pengaturan</p>

                <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; padding: 0; font-family: inherit; font-size: 0.9rem; color: inherit; cursor: pointer; width: 100%; text-align: left; margin: 8px 0;">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

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

            profileDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
</script>
