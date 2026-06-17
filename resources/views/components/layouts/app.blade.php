<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Soul Center Spa | Masajes Relajantes en León' }}</title>
        <meta name="description" content="{{ $metaDescription ?? 'Experimenta el mejor spa en León, Gto. Especialistas en masajes descontracturantes y tratamientos faciales avanzados.' }}">

        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- favicons --}}
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicons/apple-touch-icon.png')}}" />
        <link rel="icon" type="image/png" href="{{asset('favicons/favicon-96x96.png')}}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{asset('favicons/favicon.svg')}}" />
        <link rel="shortcut icon" href="{{asset('favicons/favicon.ico')}}" />
        <meta name="apple-mobile-web-app-title" content="{{ Str::limit($business->name, 12, '') }}" />
        <link rel="manifest" href="{{asset('favicons/site.webmanifest')}}" />
    </head>
    <body class="bg-spa-bg text-spa-dark font-sans antialiased">

        <x-navbar />

        <main>
            {{ $slot }}
        </main>

        <x-footer/>

    </body>
</html>
