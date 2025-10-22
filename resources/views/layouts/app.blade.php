<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:400,500,600,700" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- 
      ===============================================================
      ==> TAMBAHKAN INI DI DALAM <head> <==
      Ini akan "menarik" semua CSS dari @push('styles') di file lain.
      ===============================================================
    --}}
    @stack('styles')
</head>
<body>
    <div id="app">
        {{-- 
          Navbar kamu mungkin ada di sini
          <nav class="navbar ...">
              ...
          </nav>
        --}}

        <main>
            {{-- Ini adalah @section('content') kamu --}}
            @yield('content')
        </main>
    </div>

    {{-- 
      ===============================================================
      ==> TAMBAHKAN INI SEBELUM MENUTUP </body> <==
      Ini akan "menarik" semua JS dari @push('scripts') di file lain.
      Posisinya penting agar script dimuat setelah halaman siap.
      ===============================================================
    --}}
    @stack('scripts')
</body>
</html>