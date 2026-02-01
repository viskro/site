<x-app-layout>
    <x-slot name="title">{{ __('home.Sound Tags - Tags NFC Sonores pour Surprendre') }}</x-slot>
    <x-slot name="metaDescription">{{ __('home.Découvrez nos tags NFC avec des sons personnalisés. Surprenez vos amis avec nos tags sonores uniques. Commande simple et livraison rapide.') }}</x-slot>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-black overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- Left Content -->
                <div class="text-center lg:text-left px-4 sm:px-0">
                    <h1 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl xl:text-6xl text-white leading-tight mb-6">
                        {{ __('home.Surprenez avec des') }}
                        <span class="bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                            {{ __('home.sons uniques') }}
                        </span>
                    </h1>

                    <p class="text-lg sm:text-xl text-gray-300 mb-8 max-w-lg mx-auto lg:mx-0">
                        {{ __('home.Des tags NFC qui déclenchent des sons personnalisés quand on les approche avec un smartphone. Simple, fun et inoubliable.') }}
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#products" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 text-sm sm:text-base">
                            {{ __('home.Découvrir nos tags') }}
                            <svg class="ml-2 w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="relative z-50">
                    <div class="relative mx-auto w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96">
                        <!-- Logo depuis le storage -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="https://www.soundtags.fr/public/images/logo.png" alt="Sound Tags" class="w-full h-full object-cover drop-shadow-lg" />
                        </div>
                        <!-- Ondes -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="w-full h-full rounded-full border-2 border-white/20 animate-ping"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comment ça marche -->
    <section class="py-16 lg:py-24 bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-display font-bold text-3xl lg:text-4xl text-white mb-4">
                    {{ __('common.Comment ça marche ?') }}
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    {{ __('home.En 3 étapes simples, surprenez vos amis avec nos tags sonores') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Étape 1 -->
                <div class="text-center group">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-200 shadow-lg">
                        <span class="text-black font-bold text-xl">1</span>
                    </div>
                    <h3 class="font-semibold text-xl text-white mb-4">{{ __('home.Choisissez votre son') }}</h3>
                    <p class="text-gray-300">{{ __('home.Sélectionnez parmi nos 10 sons hilarants et uniques') }}</p>
                </div>

                <!-- Étape 2 -->
                <div class="text-center group">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-200 shadow-lg">
                        <span class="text-black font-bold text-xl">2</span>
                    </div>
                    <h3 class="font-semibold text-xl text-white mb-4">{{ __('home.Recevez votre tag') }}</h3>
                    <p class="text-gray-300">{{ __('home.Réception directe chez vous') }}</p>
                </div>

                <!-- Étape 3 -->
                <div class="text-center group">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-200 shadow-lg">
                        <span class="text-black font-bold text-xl">3</span>
                    </div>
                    <h3 class="font-semibold text-xl text-white mb-4">{{ __('home.Surprenez !') }}</h3>
                    <p class="text-gray-300">{{ __('home.Approchez un smartphone du tag et le magic opère') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Aperçu Produits -->
    <section id="products" class="py-16 lg:py-24 bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-display font-bold text-3xl lg:text-4xl text-white mb-4">
                    {{ __('home.Nos tags sonores') }}
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    {{ __('home.10 variantes uniques pour tous les goûts. Chaque tag est une surprise !') }}
                </p>
            </div>

            <!-- Grid produits réels -->
            @php
                $featuredProducts = \App\Models\Product::active()->inStock()->where('product_type', 'sound-tag')->orderBy('sort_order')->orderBy('name')->limit(5)->get();
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6 mb-12">
                @forelse($featuredProducts as $product)
                    <a href="{{ route('products.show', $product) }}" class="bg-gray-800 rounded-2xl p-4 sm:p-6 border border-gray-700 hover:border-gray-600 hover:bg-gray-750 transition-all duration-200 group block">
                        <div class="aspect-square bg-gray-700 rounded-xl mb-3 sm:mb-4 overflow-hidden flex items-center justify-center group-hover:scale-[1.02] transition-transform shadow-lg">
                            @if($product->image)
                                <img src="https://www.soundtags.fr/public/images/products/{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                            @else
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white/80" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                </svg>
                            @endif
                        </div>
                        <h3 class="font-semibold text-center mb-1 text-white truncate text-sm sm:text-base">{{ $product->name }}</h3>
                        <p class="text-xs sm:text-sm text-gray-400 text-center">{{ $product->formatted_price }}</p>
                    </a>
                @empty
                    <div class="col-span-2 sm:col-span-3 lg:col-span-5 text-center text-gray-400">
                        {{ __('home.Aucun produit disponible pour le moment.') }}
                    </div>
                @endforelse
            </div>

            <!-- CTA -->
            <div class="text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 text-sm sm:text-base">
                    {{ __('common.Voir tous les produits') }}
                    <svg class="ml-2 w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-16 lg:py-24 ">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-display font-bold text-3xl lg:text-4xl text-white mb-6">
                {{ __('home.Prêt à surprendre ?') }}
            </h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                {{ __('home.Rejoignez des milliers de personnes qui utilisent déjà nos tags pour créer des moments inoubliables.') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 text-sm sm:text-base">
                    {{ __('home.Commander maintenant') }}
                </a>
                <a href="{{ route('faq') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-black transition-all duration-200 text-sm sm:text-base">
                    {{ __('common.Questions fréquentes') }}
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
