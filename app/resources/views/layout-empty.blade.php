<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('theme') === 'dark'; $watch('darkMode', value => { localStorage.setItem('theme', value ? 'dark' : 'light'); document.documentElement.setAttribute('data-theme', value ? 'dark' : 'light'); })" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AutoMarket - @yield('titre')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo_automarket.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <livewire:styles />
    <link rel="stylesheet" href="https://noahfsc.github.io/FontAwesome-6.2.0-Pro/css/all.min.css" >
    <script>
        // Définis le thème en fonction de la valeur stockée dans le localStorage
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-theme-loaded', '');
        })();
    </script>
</head>

<body class="flex flex-col min-h-screen bg-background text-default">
    <livewire:scripts />

    <div class="flex-grow flex flex-col {{ request()->is('chat') ? '' : 'md:mx-16 md:my-16'}}">

        @yield('contenu')

    </div>

</body>

</html>