<footer class="footer">
    <div class="footer-container">

        <div class="footer-brand">
            <div class="footer-logo">
                <img src="{{ asset('images/opsi-logo-2.png') }}" alt="Logo Cakeys">
                <div>
                    <h2 style="margin: 0; font-size: 20px;">CAKEYS</h2>
                    <p style="margin: 0; font-size: 12px; color: var(--accent-color);">Create Your Own Cake</p>
                </div>
            </div>
            <p class="footer-desc">
                Toko kue custom terbaik untuk berbagai acara spesialmu 🎂
            </p>
        </div>

        <div class="footer-center">
            <h3>Menu</h3>
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('katalog') }}">Katalog</a></li>
                <li><a href="{{ route('pesanan') }}">Pesanan</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
            </ul>
        </div>

        <div class="footer-right">
            <h3>Hubungi Kami</h3>
            <p>📍 Bondowoso, Jawa Timur</p>
            <p>📞 0812-3456-7890</p>
            <p>✉️ cakeys@gmail.com</p>
        </div>

    </div>

    <div style="text-align: center; font-size: 13px; color: #bbb;">
        <p>© 2026 Cakeys | Naila's Project</p>
    </div>
</footer>
