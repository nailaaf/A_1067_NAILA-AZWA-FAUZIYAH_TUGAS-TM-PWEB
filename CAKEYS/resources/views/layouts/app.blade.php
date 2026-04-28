<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Cakeys - Dashboard Owner')</title>
    {{-- <link rel="stylesheet" href="{{ asset('style.css') }}"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="menu-overlay" id="menuOverlay"></div>

    @include('components.navbar')

    <main class="main-content dashboard-wrapper">
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
