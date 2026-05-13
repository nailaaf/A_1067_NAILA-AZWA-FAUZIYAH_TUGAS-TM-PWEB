<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAKEYS - Create Your Own Cake</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body, html { height: 100%; width: 100%; margin: 0; overflow: hidden; }

        .hero-container {
            min-height: 100vh;
            width: 100%;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url("{{ asset('choco-strawberry-landscape(1).png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
        }

        /* Navigasi: Hanya muncul di Landing Page */
        .nav-guest {
            position: absolute;
            top: 40px;
            right: 80px;
            z-index: 100;
        }
        .nav-guest a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            margin-left: 35px;
            font-size: 1.1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .nav-guest a:hover { color: #D4A373; }

        /* Layout Utama Grid 2 Kolom */
        main {
            width: 100%;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            padding: 0 100px;
            align-items: center;
        }

        /* Branding Sisi Kiri (Sama Persis UTS) */
        .login-branding h1 {
            font-size: 4rem;
            color: white;
            letter-spacing: 2px;
            font-weight: 800;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
        }
        .login-branding h2 {
            font-size: 1.5rem;
            color: #D4A373;
            font-weight: 600;
            text-shadow: 1px 1px 8px rgba(0,0,0,0.6);
        }
        .login-branding p {
            font-size: 1.1rem;
            color: white;
            opacity: 0.95;
            text-shadow: 1px 1px 8px rgba(0,0,0,0.6);
        }

        /* Card Form Sisi Kanan */
        .login-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            overflow: hidden;
            justify-self: center;
        }
        .login-form-box { padding: 40px; text-align: center; }
        .login-form-box img { width: 80px; margin-bottom: 15px; }
        .login-form-box h3 { color: #5A3E36; margin-bottom: 30px; font-size: 1.6rem; font-weight: 700; }

        .input-group { margin-bottom: 20px; text-align: left; }
        .input-group label { font-weight: 600; color: #8C6A5D; display: block; margin-bottom: 8px; font-size: 0.9rem; }
        .input-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; }

        .btn-login { width: 100%; background-color: #5A3E36; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 1rem; }
        .auth-link { margin-top: 20px; font-size: 0.85rem; color: #8C6A5D; }
        .auth-link a { color: #5A3E36; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>
    <div class="hero-container">
        @if(!Route::is('login') && !Route::is('register'))
        <div class="nav-guest">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
        @endif

        <main>
            <div class="login-branding">
                <h1>Cakeys</h1>
                <h2>Create Your Own Cake</h2>
                <p>Sistem Pemesanan Kue Custom Berbasis Web</p>
            </div>

            <div class="auth-card-container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
