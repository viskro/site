<div
    id="mobile-menu"
    class="fixed inset-0 z-50 md:hidden transform translate-x-full transition-transform duration-300 ease-in-out"
>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/70" id="mobile-menu-overlay"></div>

    <!-- Menu Panel -->
    <div class="absolute right-0 top-0 h-full w-80 max-w-full bg-gray-900 shadow-xl border-l border-gray-800">
        <div class="flex items-center justify-between p-4 border-b border-gray-800">
            <span class="font-display font-bold text-xl text-white">Menu</span>
            <button id="mobile-menu-close" class="p-2 text-gray-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="p-4">
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('home') }}" class="block py-3 text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('Accueil') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="block py-3 text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('Produits') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('packs.index') }}" class="block py-3 text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('Packs') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq') }}" class="block py-3 text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('FAQ') }}
                    </a>
                </li>
                <li>
                    <a href="#" class="block py-3 text-lg font-medium text-white border-b border-gray-800 hover:text-gray-300 transition-colors">
                        {{ __('Contact') }}
                    </a>
                </li>
            </ul>

            <!-- CTA Mobile -->
            <div class="mt-8">
                <a href="#" class="block w-full text-center px-6 py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-colors">
                    {{ __('Commander') }}
                </a>
            </div>
        </nav>
    </div>
</div>
