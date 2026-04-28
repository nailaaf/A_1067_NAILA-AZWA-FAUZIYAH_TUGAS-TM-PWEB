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
        <li><a href="{{ route('profile') }}">Profile</a></li>
    </ul>

    <div class="nav-icon">
        <div class="search-container" id="searchContainer">
            <span class="icon search-btn bitcoin-icons--search-outline" id="searchBtn"></span>
            <form class="search-box" id="searchBox" onsubmit="event.preventDefault();">
                <input type="text" id="searchInput" placeholder="Cari pesanan/produk...">
            </form>
        </div>

        <div class="profile-container" id="profileContainer">
            <span class="icon healthicons--ui-user-profile" id="profileBtn"></span>
            <div class="dropdown" id="profileDropdown">
                <p><strong>Halo, Owner!</strong></p>
                <hr style="margin: 5px 0; border: 0; border-top: 1px solid #ddd;">
                <p><a href="{{ route('profile') }}" style="color: inherit; text-decoration: none;">Profil Saya</a></p>
                <p>Pengaturan</p>
                <p style="color: #E11D48;">Logout</p>
            </div>
        </div>
    </div>
</nav>
