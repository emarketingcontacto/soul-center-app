<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Soul Center Spa | Masajes Relajantes en León' }}</title>
        <meta name="description" content="{{ $metaDescription ?? 'Experimenta el mejor spa en León, Gto. Especialistas en masajes descontracturantes y tratamientos faciales avanzados.' }}">

        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-spa-bg text-spa-dark font-sans antialiased">

        <x-navbar />

        <main>
            {{ $slot }}
        </main>

        <x-footer/>

    </body>
</html>
