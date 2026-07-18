<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


      <!-- SEO Meta Tags -->
    @php
        use App\Helpers\MetaTags;
        $meta = MetaTags::getMeta();
        $shouldIndex = MetaTags::shouldIndex();
    @endphp
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="keywords" content="{{ $meta['keywords'] }}">
    @if (!$shouldIndex)
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    @endif


    <meta name="author" content="Serviram">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="publisher" content="Serviram">
    <link rel="canonical" href="{{ url()->current() }}">



    <link rel="image_src" href="{{ asset('og-image.png') }}" />
    <meta property="og:type" content="image/png" />
    <meta property="og:title" content="Serviram - Equipos Profesionales de Cocina | San Luis Potosí" />
    <meta property="og:description"
        content="Distribuidor de equipos profesionales para cocina en San Luis Potosí. Soluciones integrales, servicio técnico y garantía. Todos los equipos que necesitas para tu negocio gastronómico." />
    <meta property="og:image" content="{{ asset('og-image.png') }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:alt"
        content="Serviram, distribuidor de equipos profesionales de cocina en San Luis Potosí." />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Serviram" />
    <meta property="og:locale" content="es_MX" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Serviram - Equipos Profesionales de Cocina">
    <meta property="og:description"
        content="Distribuidor confiable de equipos profesionales para cocina. Calidad garantizada, servicio técnico y soluciones integrales desde San Luis Potosí.">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta property="og:site_name" content="Serviram">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Serviram - Equipos Profesionales de Cocina">
    <meta property="twitter:description"
        content="Equipos profesionales de cocina con servicio técnico integral. Tu distribuidor de confianza en San Luis Potosí.">
    <meta property="twitter:image" content="{{ asset('og-image.png') }}">

    <!-- WhatsApp -->
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:secure_url" content="{{ asset('og-image.png') }}" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#8c745f">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app"></div>
</body>

</html>