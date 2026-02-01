<div
    id="mobile-menu"
    class="fixed inset-0 z-[999] md:hidden invisible opacity-0 transition-all duration-300 ease-in-out"
    style="pointer-events: none;"
>
    <!-- Overlay -->
    <div class="absolute inset-0 h-screen bg-black/80 transition-opacity duration-300" id="mobile-menu-overlay"></div>

    <!-- Menu Panel -->
    <div id="mobile-menu-panel" class="fixed right-0 top-0 h-screen w-72 sm:w-80 max-w-[85vw] bg-gray-900 shadow-2xl border-l border-gray-700 transform translate-x-full transition-transform duration-300 ease-in-out">
        <div class="flex items-center justify-between p-3 sm:p-4 border-b border-gray-800">
            <span class="font-display font-bold text-lg sm:text-xl text-white">{{ __('common.Menu') }}</span>
            <button id="mobile-menu-close" class="p-2 text-gray-300 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900 rounded-lg" aria-label="{{ __('common.Fermer le menu') }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="p-3 sm:p-4 bg-gray-900 h-full overflow-y-auto pb-20">
            <ul class="space-y-3 sm:space-y-4">
                <li>
                    <a href="{{ route('home') }}" class="mobile-menu-link block py-3 text-base sm:text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('common.Accueil') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="mobile-menu-link block py-3 text-base sm:text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('common.Produits') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('packs.index') }}" class="mobile-menu-link block py-3 text-base sm:text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('common.Packs') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq') }}" class="mobile-menu-link block py-3 text-base sm:text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('common.FAQ') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}" class="mobile-menu-link block py-3 text-base sm:text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('common.Panier') }}
                    </a>
                </li>
            </ul>

            <!-- CTA Mobile -->
            <div class="mt-6 sm:mt-8">
                <a href="{{ route('products.index') }}" class="mobile-menu-link block w-full text-center px-6 py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-colors text-sm sm:text-base">
                    {{ __('common.Commander') }}
                </a>
            </div>
        </nav>
    </div>
</div>