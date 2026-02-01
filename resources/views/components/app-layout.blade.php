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
<body class="antialiased bg-gray-900 text-gray-100 font-sans max-w-screen">
<!-- Skip to content pour l'accessibilité -->
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-black px-4 py-2 rounded-md z-50">
    {{ __('common.Aller au contenu principal') }}
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

<!-- Script pour synchroniser localStorage avec le cookie de langue -->
<script>
    (function() {
        // Ne synchroniser que si on n'est pas en train de changer de langue
        // Vérifier si on vient de changer de langue (flag dans sessionStorage)
        const justChangedLocale = sessionStorage.getItem('locale-changing');
        if (justChangedLocale) {
            sessionStorage.removeItem('locale-changing');
            return; // Ne pas synchroniser si on vient de changer de langue
        }
        
        // Récupérer la langue depuis localStorage si disponible
        const storedLocale = localStorage.getItem('locale');
        const currentLocale = '{{ app()->getLocale() }}';
        
        // Si localStorage contient une langue différente de celle du serveur, synchroniser
        if (storedLocale && storedLocale !== currentLocale && (storedLocale === 'fr' || storedLocale === 'en')) {
            // Envoyer la langue au serveur pour synchroniser le cookie
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (csrfToken) {
                fetch('{{ route('locale.set') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ locale: storedLocale })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recharger la page pour appliquer la langue
                        window.location.reload();
                    }
                }).catch(err => {
                    console.error('Erreur lors de la synchronisation de la langue:', err);
                });
            }
        } else if (!storedLocale && (currentLocale === 'fr' || currentLocale === 'en')) {
            // Si pas de localStorage mais une langue valide côté serveur, synchroniser localStorage
            localStorage.setItem('locale', currentLocale);
        }
    })();
</script>
</body>
</html>
