@extends('layouts.app')

@section('title', 'Preferensi Owner - Cakeys')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh; padding: 40px 5%;">

    <div style="width: 100%; max-width: 500px; background-color: var(--surface-color); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">

        <div style="background-color: var(--primary-color); padding: 25px 20px; text-align: left;">
            <h2 style="margin: 0; font-size: 1.4rem; color: #FFFFFF;">⚙️ Pengaturan Preferensi</h2>
            <p style="margin: 5px 0 0; font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">Sesuaikan tampilan Dashboard Cakeys senyaman mungkin untuk Anda.</p>
        </div>

        <div style="padding: 30px; text-align: left; display: block;">
            <form id="preferensi-form">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-color); font-size: 0.95rem;">Pilih Tema Aplikasi</label>
                    <select id="theme-select" name="theme" style="width: 100%; padding: 10px; border-radius: 8px; background-color: var(--background-color); color: var(--text-color); border: 1px solid var(--border-color); font-family: inherit; font-size: 0.95rem;">
                        <option value="light">Terang (Light)</option>
                        <option value="dark">Gelap (Dark)</option>
                        <option value="system">Sistem Default</option>
                    </select>
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-color); font-size: 0.95rem;">Ukuran Teks (Eksperimental)</label>
                    <select id="font-select" name="font_size" style="width: 100%; padding: 10px; border-radius: 8px; background-color: var(--background-color); color: var(--text-color); border: 1px solid var(--border-color); font-family: inherit; font-size: 0.95rem;">
                        <option value="small">Kecil</option>
                        <option value="medium" selected>Sedang</option>
                        <option value="large">Besar</option>
                    </select>
                </div>

                <button type="submit" style="background-color: var(--primary-color); color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-family: inherit; font-size: 1rem; transition: 0.3s; display: inline-block;">
                    Simpan Preferensi
                </button>
            </form>
        </div>
    </div>
</div>

<div id="successPreferensiModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 99999; justify-content: center; align-items: center; animation: fadeIn 0.3s forwards;">
    <div style="background-color: var(--surface-color); padding: 40px; border-radius: 15px; text-align: center; max-width: 400px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid var(--primary-color); transform: translateY(20px); animation: slideUp 0.4s forwards ease-out;">

        {{-- <div style="font-size: 4rem; margin-bottom: 10px;">✨</div> --}}
        <h2 style="color: var(--primary-color); margin-bottom: 15px;">Berhasil!</h2>
        <p style="color: var(--text-color); margin-bottom: 30px; font-size: 0.95rem;">Pengaturan preferensi tampilan Anda telah berhasil disimpan.</p>

        <button type="button" onclick="document.getElementById('successPreferensiModal').style.display='none'" style="padding: 12px 35px; border-radius: 8px; background-color: var(--primary-color); color: white; border: none; font-family: inherit; font-weight: bold; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Oke, Mantap!</button>
    </div>
</div>

<style>
    @keyframes fadeIn { to { opacity: 1; } }
    @keyframes slideUp { to { transform: translateY(0); } }
</style>

<script>
    document.getElementById('preferensi-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const theme = document.getElementById('theme-select').value;
        const fontSize = document.getElementById('font-select').value;
        const csrfToken = document.querySelector('input[name="_token"]').value;

        fetch('{{ route("preferensi.simpan") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ theme: theme, font_size: fontSize })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // TAMPILKAN MODAL CAKEYS, BUKAN ALERT BAWAAN BROWSER
                document.getElementById('successPreferensiModal').style.display = 'flex';

                if(theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    const themeToggleBtn = document.getElementById('themeToggle');
                    if (themeToggleBtn) themeToggleBtn.textContent = '☀️';
                } else if (theme === 'light') {
                    document.documentElement.classList.remove('dark');
                    const themeToggleBtn = document.getElementById('themeToggle');
                    if (themeToggleBtn) themeToggleBtn.textContent = '🌙';
                }

                document.documentElement.classList.remove('font-small', 'font-medium', 'font-large');
                document.documentElement.classList.add('font-' + fontSize);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection
