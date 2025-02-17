<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AutoMarket - @yield('titre')</title>

    @vite('resources/css/app.css')
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo_automarket.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <livewire:styles />
    <link rel="stylesheet" href="https://noahfsc.github.io/FontAwesome-6.2.0-Pro/css/all.min.css" >
    <script>
        document.addEventListener('livewire:load', function () {
            if (typeof Alpine === 'undefined') {
                var script = document.createElement('script');
                script.src = '//unpkg.com/alpinejs';
                script.defer = true;
                document.head.appendChild(script);
            }
        });
    </script>
</head>

<body class="flex flex-col min-h-screen bg-background">
    <livewire:scripts />

    <div class="flex-grow flex flex-col {{ request()->is('chat') ? '' : 'md:mx-16 md:my-16'}}">

        @yield('contenu')

    </div>

</body>

</html>