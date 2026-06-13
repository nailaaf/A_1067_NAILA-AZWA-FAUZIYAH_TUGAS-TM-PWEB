@extends('layouts.guest')

@section('content')
<div class="login-card">
    <div class="login-form-box">
        <img src="{{ asset('images/opsi-logo-2-baru.png') }}" alt="Logo Cakeys">
        <h3>Ayo Masuk</h3>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email anda" required autofocus>
            </div>

            <div class="input-group" style="margin-bottom: 8px;">
                <label>Kata Sandi</label>
                <div style="position: relative;">
                    <input type="password" name="password" id="password" placeholder="Masukkan kata sandi anda" required style="width: 100%; padding-right: 40px; box-sizing: border-box;">

                    <span id="togglePassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888; display: flex; align-items: center; transition: 0.3s;">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- TAMBAHAN: Link Lupa Password -->
            <div style="text-align: right; margin-bottom: 20px;">
                <a href="{{ route('password.request') }}" style="color: #5A3E36; font-size: 0.85rem; text-decoration: none; font-weight: 600; transition: 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                    Lupa Kata Sandi?
                </a>
            </div>

            <button type="submit" class="btn-login">Login</button>

            <p class="auth-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </p>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        togglePassword.addEventListener('click', function () {
            // Ubah atribut tipe input (dari password ke text, atau sebaliknya)
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Ubah bentuk ikon mata
            if (type === 'text') {
                // SVG Mata Dicoret (saat password terlihat)
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
                eyeIcon.style.color = '#5A3E36'; // Berubah warna mengikuti tema saat aktif
            } else {
                // SVG Mata Terbuka (saat password disembunyikan)
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                eyeIcon.style.color = '#888';
            }
        });
    });
</script>
@endsection
