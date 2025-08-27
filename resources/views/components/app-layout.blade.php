<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'Sound Tags - Tags NFC avec sons personnalisés. Surprenez vos amis avec nos tags sonores uniques.' }}">

    <title>{{ $title ?? 'Sound Tags - Tags NFC Sonores' }}</title>

    <!-- Preconnect pour optimiser les performances -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Fonts - Inter pour le texte, Poppins pour les titres -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" href="/favicon.png">

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (chargé après nos assets pour garantir la dispo des factories globales) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts additionnels si nécessaire -->
    {{ $head ?? '' }}
</head>
<body class="antialiased bg-gray-900 text-gray-100 font-sans">
<!-- Skip to content pour l'accessibilité -->
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-black px-4 py-2 rounded-md z-50">
    {{ __('Aller au contenu principal') }}
</a>

<!-- Header -->
<x-header />

<!-- Main Content -->
<main id="main-content" class="min-h-screen">
    {{ $slot }}
</main>

<!-- Footer -->
<x-footer />

<!-- Mini Cart Overlay (si panier) -->
<div id="cart-overlay" class="hidden"></div>

<!-- Scripts de fin de page -->
{{ $scripts ?? '' }}
</body>
</html>
