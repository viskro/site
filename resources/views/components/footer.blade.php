<footer class="bg-black text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Main Footer Content -->
        <div class="py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Brand -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                            </svg>
                        </div>
                        <span class="font-display font-bold text-xl">Sound Tags</span>
                    </div>
                    <p class="text-gray-300 max-w-md mb-6">
                        {{ __('common.Des tags NFC avec des sons personnalisés pour surprendre vos amis. Simple, fun et inoubliable.') }}
                    </p>

                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="TikTok">
                            <img src="https://www.soundtags.fr/public/images/socials/tiktok.svg" alt="TikTok" class="w-5 h-5 invert opacity-80 hover:opacity-100" />
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors" aria-label="Instagram">
                            <img src="https://www.soundtags.fr/public/images/socials/instagram.svg" alt="Instagram" class="w-5 h-5 invert opacity-80 hover:opacity-100" />
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <div>
                    <h3 class="font-semibold mb-4">{{ __('common.Navigation') }}</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Accueil') }}</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Produits') }}</a></li>
                        <li><a href="{{ route('packs.index') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Packs') }}</a></li>
                        <li><a href="{{ route('faq') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.FAQ') }}</a></li>
                    </ul>
                </div>

                <!-- Légal -->
                <div>
                    <h3 class="font-semibold mb-4">{{ __('common.Informations') }}</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('mentions') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Mentions légales') }}</a></li>
                        <li><a href="{{ route('cgv') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.CGV') }}</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Confidentialité') }}</a></li>
                        <li><a href="{{ route('cookies') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Cookies') }}</a></li>
                        <li><a href="{{ route('livraison-retours') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Livraison & Retours') }}</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-300 hover:text-white transition-colors">{{ __('common.Conditions d\'utilisation') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Sound Tags. {{ __('common.Tous droits réservés.') }}
                </p>
                <p class="text-gray-400 text-sm mt-2 md:mt-0">
                    {{ __('common.Fabriqué avec â¤ï¸ pour surprendre') }}
                </p>
            </div>
        </div>
    </div>
</footer>
