<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Cakeys - Dashboard Owner')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="menu-overlay" id="menuOverlay"></div>
    @include('partials.navbar')

    @if(session('success'))
        <div id="flash-message" style="position: fixed; top: 90px; right: 20px; background-color: #f4e8e1; color: #5A3E36; padding: 15px 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 9999; font-weight: 600; border-left: 5px solid #5A3E36; transition: opacity 0.5s ease;">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let flashMessage = document.getElementById('flash-message');
                if(flashMessage) {
                    flashMessage.style.opacity = '0';
                    setTimeout(() => flashMessage.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    <main class="main-content {{--dashboard-wrapper--}}">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
