<header class="sticky top-0 z-40 bg-gray-900/95 backdrop-blur-md border-b border-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

            <!-- Logo -->
            <div class="flex-shrink-0">
                {{-- <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                        </svg>
                    </div>
                    <span class="font-display font-bold text-xl text-white group-hover:text-gray-300 transition-colors">
                        Sound Tags
                    </span> --}}
                    <img src="https://www.soundtags.fr/public/images/logo.png" alt="Sound Tags" class="w-20 h-20 sm:w-30 sm:h-30 object-cover" />
                </a>
            </div>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors font-medium">
                    {{ __('common.Accueil') }}
                </a>
                <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors font-medium">
                    {{ __('common.Produits') }}
                </a>
                <a href="{{ route('packs.index') }}" class="text-gray-300 hover:text-white transition-colors font-medium">
                    {{ __('common.Packs') }}
                </a>
                <a href="{{ route('faq') }}" class="text-gray-300 hover:text-white transition-colors font-medium">
                    {{ __('common.FAQ') }}
                </a>
            </nav>

            <!-- Actions (Langue, Panier, Menu Mobile) -->
            <div class="flex items-center space-x-2 sm:space-x-4">

                <!-- Language Switcher -->
                <x-layout.language-switcher />

                <!-- Panier -->
                <a href="{{ route('cart.index') }}">
                    <button
                        id="cart-trigger"
                        class="relative p-1.5 sm:p-2 text-gray-300 hover:text-white transition-colors cursor-pointer"
                        aria-label="{{ __('common.Ouvrir le panier') }}"
                    >
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z"/>
                        </svg>
                        <!-- Badge quantité -->
                        @if($cartCount > 0)
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-white text-black text-xs rounded-full h-4 w-4 sm:h-5 sm:w-5 flex items-center justify-center font-medium">
                                {{ $cartCount }}
                            </span>
                        @else
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-white text-black text-xs rounded-full h-4 w-4 sm:h-5 sm:w-5 flex items-center justify-center font-medium hidden">
                                0
                            </span>
                        @endif
                    </button>
                </a>


                <!-- Menu Mobile -->
                <button
                    id="mobile-menu-trigger"
                    class="md:hidden p-1.5 sm:p-2 text-gray-300 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded-lg"
                    aria-label="{{ __('common.Ouvrir le menu') }}"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                >
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <x-layout.mobile-menu />
</header>

<script>
/**
 * Met à jour le compteur du panier dans le header
 * @param {number} count - Le nouveau nombre d'articles
 */
window.updateCartCount = function(count) {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
        
        if (count > 0) {
            cartCountElement.classList.remove('hidden');
        } else {
            cartCountElement.classList.add('hidden');
        }
    }
};

/**
 * Gestion du menu mobile
 */
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuTrigger = document.getElementById('mobile-menu-trigger');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuPanel = document.getElementById('mobile-menu-panel');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    function openMobileMenu() {
        if (mobileMenu && mobileMenuPanel) {
            mobileMenu.style.pointerEvents = 'auto';
            mobileMenu.classList.remove('invisible', 'opacity-0');
            mobileMenu.classList.add('visible', 'opacity-100');
            
            // Petit délai pour l'animation
            setTimeout(() => {
                mobileMenuPanel.classList.remove('translate-x-full');
                mobileMenuPanel.classList.add('translate-x-0');
            }, 10);
            
            document.body.style.overflow = 'hidden';
            
            if (mobileMenuTrigger) {
                mobileMenuTrigger.setAttribute('aria-expanded', 'true');
            }
        }
    }

    function closeMobileMenu() {
        if (mobileMenu && mobileMenuPanel) {
            mobileMenuPanel.classList.remove('translate-x-0');
            mobileMenuPanel.classList.add('translate-x-full');
            
            setTimeout(() => {
                mobileMenu.classList.remove('visible', 'opacity-100');
                mobileMenu.classList.add('invisible', 'opacity-0');
                mobileMenu.style.pointerEvents = 'none';
            }, 300);
            
            document.body.style.overflow = '';
            
            if (mobileMenuTrigger) {
                mobileMenuTrigger.setAttribute('aria-expanded', 'false');
            }
        }
    }

    // Ouvrir le menu
    if (mobileMenuTrigger) {
        mobileMenuTrigger.addEventListener('click', openMobileMenu);
    }

    // Fermer le menu avec le bouton X
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }

    // Fermer le menu en cliquant sur l'overlay
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }

    // Fermer le menu avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });

    // Fermer le menu lors du redimensionnement vers desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            closeMobileMenu();
        }
    });

    // Fermer le menu quand on clique sur un lien de navigation
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('mobile-menu-link')) {
            closeMobileMenu();
        }
    });
});
</script>
