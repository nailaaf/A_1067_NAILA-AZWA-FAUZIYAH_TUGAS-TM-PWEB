@extends('layouts.customer')

@section('title', 'Beranda - Cakeys')

@section('content')
    <section id="weather-info" style="background-color: var(--background-light); padding: 12px 15px; text-align: center; border-bottom: 1px solid #EFE8DF; font-size: 0.95rem;">
        <p style="margin: 0; color: var(--secondary-color); font-weight: 500;">
            ⏳ Mengambil data cuaca sekitar UNEJ Jember...
        </p>
    </section>

    {{-- <section style="display: flex; align-items: center; justify-content: space-between; padding: 40px 5%; background-color: var(--surface-color); min-height: 70vh;">
        <div style="flex: 1; padding-right: 40px;">
            <h1 style="font-size: 3rem; color: var(--primary-color); line-height: 1.2; margin-bottom: 20px;">
                CAKEYS <br>
                <span style="color: var(--accent-color); display: inline-flex; align-items: center; gap: 10px;">
                    Create Your Own Cake
                    <img src="{{ asset('images/Cakeys-cake-aja.png') }}" alt="Logo Cakeys" style="height: 1.2em; border-radius: 5px;">
                </span>
            </h1>
            <p style="font-size: 1.1rem; color: var(--secondary-color); margin-bottom: 30px;">
                Sistem Pemesanan Kue Custom Berbasis Web. Wujudkan desain kue impianmu bersama kami dengan bahan premium yang lezat!
            </p>
            <a href="{{ url('/katalog') }}" style="background-color: var(--primary-color); color: white; padding: 12px 30px; border-radius: 30px; font-weight: bold; font-size: 1.1rem; display: inline-block;">Lihat Katalog</a>
        </div>
        <div style="flex: 1; text-align: right;">
            <img src="{{ asset('images/choco-strawberry-landscape(1).png') }}" alt="cakeys cake" style="max-width: 100%; height: auto; border-radius: 20px; box-shadow: var(--shadow-md);">
        </div>
    </section> --}}
    <section class="hero-section">
        <div class="hero-text">
            <h1>
                CAKEYS <br>
                <span class="hero-slogan">
                    Create Your Own Cake
                    <img src="{{ asset('images/Cakeys-cake-aja.png') }}" alt="Logo Cakeys" class="hero-logo">
                </span>
            </h1>
            <p class="hero-desc">
                Sistem Pemesanan Kue Custom Berbasis Web. Wujudkan desain kue impianmu bersama kami dengan bahan premium yang lezat!
            </p>
            <a href="{{ url('/katalog') }}" class="btn-katalog">Lihat Katalog</a>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/choco-strawberry-landscape(1).png') }}" alt="cakeys cake">
        </div>
    </section>

    <section style="padding: 60px 5%; text-align: center; background-color: var(--surface-color);">
        <h2 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 10px;">Mengapa Memilih Cakeys?</h2>
        <p style="color: var(--secondary-color); margin-bottom: 40px;">Alasan kenapa kuemu harus dari kami</p>

        <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
            <div style="background: var(--background-light); padding: 30px; border-radius: 15px; width: 300px; box-shadow: var(--shadow-sm); border: 1px solid #EFE8DF;">
                {{-- <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px;">🍰 Bahan Premium</h3> --}}
                <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 64 64" style="flex-shrink: 0;">
                        <path d="M0 0h64v64H0z" fill="none" />
                        <path fill="#d3976e" d="M57.7 54.7L2 62V51.6l55.7-7.5zm.1-21.5L2 40.9v-11L57.8 22z" />
                        <path fill="#fff" d="M57.7 44.1L2 51.6V40.9l55.8-7.7z" />
                        <path fill="#ef4d3c" d="M20.8 39.7c.2 4.4-3.5 8.4-8.3 9.1c-4.8.6-8.9-2.3-9.1-6.7z" />
                        <path fill="#ff717f" d="M18.6 40c.1 3.3-2.6 6.3-6.2 6.8s-6.6-1.7-6.8-5z" />
                        <path fill="#ef4d3c" d="M56.2 34.9c0 4.4-3.9 8.5-8.8 9.2c-4.8.7-8.8-2.4-8.9-6.8z" />
                        <path fill="#ff717f" d="M53.9 35.2c0 3.3-2.9 6.4-6.5 6.9s-6.6-1.8-6.6-5z" />
                        <path fill="#ef4d3c" d="M21.2 47.6c-.2-4.3 3.6-8.5 8.4-9.1c4.9-.7 8.9 2.4 9 6.7z" />
                        <path fill="#ff717f" d="M23.4 47.3c-.1-3.2 2.7-6.3 6.3-6.8s6.6 1.8 6.7 5z" />
                        <path fill="#c98659" d="m3 34.7l2.7 2.1L8.2 34l-2.8-2zm17.8-.5l2.7 2.1l2.5-2.8l-2.7-2zm26.7-2.7l2.6 2.1l2.6-2.8l-2.6-2.1zm-21.9-.9l2.2 1.7l2-2.3l-2.2-1.6zm20-2.7l-2.1 2.2l2.1 1.6l2.1-2.2zm-26.9.3l-2 2.2l2.1 1.6l2.1-2.2zM8.5 36.4l2.4 1.8l2.2-2.4l-2.4-1.8zm5.8-5.1l-1.4 1.6l1.6 1.1l1.4-1.5zm16.5 1.1l1.5 1.1l1.4-1.6l-1.5-1.1zm4.3-3.6l1.6 1.2l1.4-1.6l-1.5-1.2zm4.6 3.3l1.5 1.1l1.4-1.5l-1.5-1.2zm9.9-6.7l-1.5-1.2l-1.4 1.6l1.5 1.2zm-15.5 8.8l1.5 1.2l1.4-1.6l-1.5-1.1zm-18 2.5l1.5 1.1l1.4-1.5l-1.5-1.1zm-5.6-5.9L9 29.6l-1.4 1.6l1.5 1.1zm44.1-6.6l-1.5 1.6l1.5 1.2l1.4-1.6zM56 50.1l-2.6-2l-2.5 2.7l2.6 2zm-17.4.5l-2.6-2l-2.6 2.7l2.7 1.9zm-26.1 2.6l-2.6-2l-2.5 2.7l2.7 1.9zm21.3.8l-2.1-1.5l-2 2.1l2.1 1.5zm-19.3 2.6l1.9-2.1l-2.1-1.5l-1.9 2.1zm26-.3l2-2.1l-2.1-1.5l-2 2.1zm10.2-7.8l-2.3-1.7l-2.2 2.3l2.2 1.7zm-5.9 4.9l1.4-1.5l-1.5-1.1l-1.4 1.5zm-16-1l-1.5-1.1l-1.4 1.5l1.5 1.1zm-4.2 3.3l-1.5-1l-1.4 1.4l1.5 1.1zm-4.5-3.1l-1.5-1.1l-1.4 1.5l1.5 1.1zm-9.4 6.3l1.5 1.1l1.3-1.5l-1.5-1.1zm14.8-8.3L24 49.5L22.7 51l1.5 1.1zm17.7-2.4l-1.4-1.1l-1.5 1.5l1.5 1.1zm5.3 5.7l1.4 1.1l1.4-1.5l-1.4-1.1zM6 60l1.4-1.5l-1.5-1.1l-1.4 1.5z" />
                        <path fill="#8f6453" d="M62 21.6c0-4.3-17.8-8.7-21.7-8.2C23.6 15.6 2 29.9 2 29.9c16.6-2.2 50.1-6.5 53-6.8c1.5-.2 2.4.1 2.4 1.3v30.3l4.6-.6z" />
                        <path fill="#724e41" d="M55.9 20.9c8.5-1.2-15.5-7.7-19.2-7.2c-15.9 2.1-32 14.4-32 14.4s49.2-6.9 51.2-7.2" />
                        <path fill="#8cc63e" d="m42.3 10l1.9-2.7l-4.4-.4l-.5-4.1l-2.9 1.8L32.9 2l-1 11l13.1.2z" />
                        <path fill="#ef4d3c" d="M39.8 18.5c-4.1 3.8-13.2 4.3-15.1 2.5c-2-1.8-1.5-10.1 2.7-14c3.1-2.8 7.7-1.5 10.9 1.4c3.1 3 4.5 7.3 1.5 10.1" />
                        <path fill="#ffffc4" d="m29.2 16.4l-.7.7l.7.7l.8-.7zm10.3-4l-.7.6l.7.7l.7-.7zm-3.4.6l-.7.7l.7.7l.7-.7zm-3.3-.6l-.7.6l.7.7l.7-.7zm3.7-2.7l-.7.7l.7.6l.8-.6zm-2-2.8l-.7.6l.7.7l.7-.7zm-2.4 2.4l-.7.7l.7.6l.7-.6zm-3 2.9l-.7.6l.7.7l.7-.7zM33 16l-.8.7l.8.7l.7-.7zm5.2.1l-.7.7l.7.7l.7-.7zm-2.8 2.7l-.8.7l.8.6l.7-.6zm-4.7.7l-.7.6l.7.7l.7-.7zm-4.5-1.4l-.7.7l.7.7l.7-.7zm-.5-3.4l-.7.7l.7.6l.8-.6zm2.2-6.5l-.7.6l.7.7l.7-.7zm-1.7 3l-.7.7l.7.6l.7-.6zM30.9 6l-.7.7l.7.6l.7-.6z" />
                    </svg>
                    <span style="line-height: 1;">Bahan Premium</span>
                </h3>
                <p style="color: var(--text-color); font-size: 0.95rem;">Kami hanya menggunakan bahan-bahan berkualitas tinggi untuk rasa yang tak terlupakan.</p>
            </div>
            <div style="background: var(--background-light); padding: 30px; border-radius: 15px; width: 300px; box-shadow: var(--shadow-sm); border: 1px solid #EFE8DF;">
                {{-- <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px;">✨ Custom Desain</h3> --}}
                <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 32 32">
                        <path d="M0 0h32v32H0z" fill="none" />
                        <path fill="#F9C23C" d="M10.52 7.052a1.17 1.17 0 0 1-.639-.636L8.93 4.257c-.178-.343-.69-.343-.858 0l-.952 2.16a1.28 1.28 0 0 1-.638.635l-1.214.524a.462.462 0 0 0 0 .838l1.214.524c.293.121.523.353.638.636l.952 2.169c.178.343.69.343.858 0l.952-2.17c.126-.282.356-.504.638-.635l1.214-.524a.462.462 0 0 0 0-.838zm15.054 6.503a3.73 3.73 0 0 1-1.922-1.977L20.79 4.81a1.432 1.432 0 0 0-2.58 0l-2.863 6.768a3.8 3.8 0 0 1-1.921 1.977l-3.622 1.64c-1.072.53-1.072 2.08 0 2.61l3.622 1.64a3.74 3.74 0 0 1 1.922 1.977l2.862 6.768a1.432 1.432 0 0 0 2.58 0l2.863-6.768a3.8 3.8 0 0 1 1.921-1.977l3.622-1.64c1.072-.53 1.072-2.08 0-2.61zM8.281 20.33c.16.392.454.696.822.872l1.55.725a.646.646 0 0 1 0 1.146l-1.55.725c-.368.176-.661.49-.822.872l-1.228 2.977a.61.61 0 0 1-1.106 0L4.72 24.67a1.66 1.66 0 0 0-.822-.872l-1.55-.725a.646.646 0 0 1 0-1.146l1.55-.725c.368-.176.661-.49.822-.872l1.228-2.977a.61.61 0 0 1 1.106 0z" />
                    </svg>
                    <span style="line-height: 1;">Custom Desain</span>
                </h3>
                <p style="color: var(--text-color); font-size: 0.95rem;">Wujudkan kue impianmu dengan desain yang sepenuhnya bisa dikustomisasi.</p>
            </div>
            <div style="background: var(--background-light); padding: 30px; border-radius: 15px; width: 300px; box-shadow: var(--shadow-sm); border: 1px solid #EFE8DF;">
                {{-- <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px;">🚚 Pengiriman Aman</h3> --}}
                <h3 style="color: var(--primary-color); font-size: 1.3rem; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512">
                        <path d="M0 0h512v512H0z" fill="none" />
                        <path fill="#C7CFD3" d="M504.505 377.843H171.057V115.342c0-26.6 21.563-48.163 48.163-48.163h237.123c26.6 0 48.163 21.563 48.163 48.163v262.501z" />
                        <path fill="#FF473E" d="M87.196 198.558h61.285c12.468 0 22.576 11.188 22.576 24.989v153.961H6.812v-75.8c0-8.864 2.664-17.477 7.573-24.481l44.302-63.211c6.834-9.752 17.358-15.458 28.509-15.458" />
                        <path fill="#2B3B47" d="M15.467 420.116h482.79c7.354 0 13.315-5.961 13.315-13.315V384.22a6.71 6.71 0 0 0-6.712-6.712H6.908a4.756 4.756 0 0 0-4.756 4.755V406.8c0 7.354 5.962 13.316 13.315 13.316" />
                        <path fill="#76DFFF" d="m37.741 282.906l38.847-55.394c.905-1.291 2.297-2.046 3.771-2.046h45.922c2.639 0 4.778 2.375 4.778 5.304v55.394c0 2.929-2.139 5.304-4.778 5.304H41.512c-3.977 0-6.214-5.079-3.771-8.562" />
                        <path fill="#FFD469" d="M20.039 352.665H6.812v-35.062h13.227c6.202 0 11.229 5.027 11.229 11.229v12.603c0 6.203-5.027 11.23-11.229 11.23" />
                        <path fill="#597B91" d="M128.69 432.253c0 22.227-18.018 40.245-40.245 40.245S48.2 454.48 48.2 432.253s18.018-40.245 40.245-40.245s40.245 18.019 40.245 40.245m152.916-40.244c-22.227 0-40.245 18.018-40.245 40.245s18.018 40.245 40.245 40.245s40.245-18.018 40.245-40.245s-18.019-40.245-40.245-40.245m112.35 0c-22.227 0-40.245 18.018-40.245 40.245s18.018 40.245 40.245 40.245s40.245-18.018 40.245-40.245s-18.018-40.245-40.245-40.245" />
                        <path fill="#2B3B47" d="M114.823 432.253c0 14.568-11.81 26.378-26.378 26.378s-26.378-11.81-26.378-26.378s11.81-26.378 26.378-26.378s26.378 11.81 26.378 26.378m166.783-26.377c-14.568 0-26.378 11.81-26.378 26.378s11.81 26.378 26.378 26.378s26.378-11.81 26.378-26.378s-11.81-26.378-26.378-26.378m112.35 0c-14.568 0-26.378 11.81-26.378 26.378s11.81 26.378 26.378 26.378s26.378-11.81 26.378-26.378s-11.81-26.378-26.378-26.378" />
                    </svg>
                    <span style="line-height: 1;">Pengiriman Aman</span>
                </h3>
                <p style="color: var(--text-color); font-size: 0.95rem;">Dikirim langsung ke rumah/kampus dengan aman agar kue tetap utuh sempurna.</p>
            </div>
        </div>
    </section>

    <section class="dashboard-section" style="max-width: 900px; margin: 40px auto; text-align: center;">
        <h2 style="color: var(--primary-color); margin-bottom: 25px;">Statistik Kunjungan Anda</h2>

        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-bottom: 30px;">
            <div class="card" style="flex: 1; min-width: 220px;">
                <h3 style="font-size: 1rem;">Total Kunjungan</h3>
                <p class="angka" style="font-size: 2.5rem; margin-top: 10px;">{{ $visits }}</p>
                <p style="font-size: 0.85rem; color: var(--secondary-color);">Kali dilihat</p>
            </div>

            <div class="card" style="flex: 1; min-width: 220px;">
                <h3 style="font-size: 1rem;">Kunjungan Pertama</h3>
                <p class="teks" style="font-size: 1.1rem; margin-top: 15px;">{{ $waktu_pertama }}</p>
            </div>

            <div class="card" style="flex: 1; min-width: 220px;">
                <h3 style="font-size: 1rem;">Kunjungan Terakhir</h3>
                <p class="teks" style="font-size: 1.1rem; margin-top: 15px;">{{ $waktu_terakhir }}</p>
            </div>
        </div>

        <form action="{{ route('kunjungan.reset') }}" method="POST">
            @csrf
            <button type="submit" style="background-color: #740A03; color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 1rem; transition: 0.3s;">
                Reset Hitungan
            </button>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchWeather();
        });

        async function fetchWeather() {
            const weatherContainer = document.getElementById('weather-info');

            try {
                const response = await fetch('https://wttr.in/Jember?format=j1');
                if (!response.ok) throw new Error('Gagal memuat data');
                const data = await response.json();

                const tempC = data.current_condition[0].temp_C;
                const desc = data.current_condition[0].weatherDesc[0].value;
                const city = data.nearest_area[0].areaName[0].value;

                weatherContainer.innerHTML = `
                    <p style="margin: 0; color: var(--primary-color); font-weight: 600; font-size: 1rem;">
                        🌤️ Cuaca di ${city} saat ini: <span style="color: var(--accent-color); font-weight: 700;">${tempC}°C</span> (${desc}).
                        <span style="font-weight: 400; font-size: 0.95rem; color: var(--secondary-color); margin-left: 10px;">Cuaca yang pas buat nikmatin kue CAKEYS!</span>
                    </p>
                `;
            } catch (error) {
                console.error(error);
                weatherContainer.innerHTML = '<p style="margin: 0; color: #E11D48; font-weight: 500;">❌ Gagal memuat info cuaca, tapi CAKEYS tetap siap melayanimu!</p>';
            }
        }
    </script>
@endsection
