@extends('layouts.guest')

@section('content')
<div class="login-card">
    <div class="login-form-box">
        <img src="{{ asset('images/opsi-logo-2-baru.png') }}" alt="Logo Cakeys">
        <h3 style="margin-bottom: 10px;">Lupa Kata Sandi?</h3>

        <p style="font-size: 0.85rem; color: #666; margin-bottom: 25px; line-height: 1.5; text-align: center;">
            Masukkan email yang terdaftar untuk mengirimkan tautan reset kata sandi Anda.
        </p>

        @if (session('status'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; text-align: center; border: 1px solid #c3e6cb;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email anda" required autofocus>

                @error('email')
                    <span style="color: #DC3545; font-size: 0.85rem; display: block; margin-top: 5px; text-align: left;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login" style="margin-top: 10px;">Kirim Link Reset</button>

            <p class="auth-link" style="margin-top: 20px;">
                Ingat kata sandi Anda? <a href="{{ route('login') }}">Kembali ke Login</a>
            </p>
        </form>
    </div>
</div>
@endsection
