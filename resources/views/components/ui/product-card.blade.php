@props(['product'])
@php
    $imageUrl = "https://www.soundtags.fr/public/images/products/" . data_get($product, 'image');
    $audioUrl = "https://www.soundtags.fr/public/audio/" . data_get($product, 'audio_file');
    $isOnSale = (bool) data_get($product, 'is_on_sale', false);
    $discount = data_get($product, 'discount_percentage');
    $name = data_get($product, 'name');
    $shortDescription = data_get($product, 'short_description');
    $formattedPrice = data_get($product, 'formatted_price');
    $originalPrice = data_get($product, 'original_price');
    // Tolérance: si l'info stock est absente (tableau partiel), considérer en stock par défaut
    $inStock = true; // stock illimité
    $canPurchase = is_object($product)
        ? $product->canBePurchased()
        : ((bool) data_get($product, 'is_active', true) && $inStock);
    $slug = data_get($product, 'slug');
    $showUrl = $slug ? route('products.show', $slug) : (is_object($product) ? route('products.show', $product) : '#');
    \Log::info('product_card_debug', [
        'type' => is_object($product) ? get_class($product) : gettype($product),
        'id' => data_get($product, 'id'),
        // 'stock_quantity' retiré
        'is_active' => data_get($product, 'is_active'),
        'has_image_url' => (bool) $imageUrl,
        'inStock' => $inStock,
        'canPurchase' => $canPurchase,
        'array_keys' => is_array($product) ? array_keys($product) : null,
    ]);
@endphp

<div class="bg-gray-800 rounded-2xl border border-gray-700 hover:border-gray-600 transition-all duration-200 group overflow-hidden">
    <!-- Image -->
    <div class="aspect-square bg-gray-900 relative overflow-hidden">
        @if($imageUrl)
            <img
                src="{{ $imageUrl }}"
                alt="{{ $name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
            >
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                </svg>
            </div>
        @endif

        <!-- Badge promo -->
        @if($isOnSale)
            <div class="absolute top-3 left-3 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-medium">
                -{{ $discount }}%
            </div>
        @endif



        <!-- Stock status -->
        <!-- Stock illimité: pas de badge rupture -->
    </div>

    <!-- Content -->
    <div class="p-6">
        <h3 class="font-semibold text-white mb-2 group-hover:text-gray-300 transition-colors">
            <a href="{{ $showUrl }}">
                {{ $name }}
            </a>
        </h3>

        @if($shortDescription)
            <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                {{ $shortDescription }}
            </p>
        @endif

        <!-- Prix -->
        <div class="flex items-baseline space-x-2 mb-4">
            <span class="text-xl font-bold text-white">
                {{ $formattedPrice }}
            </span>
            @if($isOnSale)
                <span class="text-sm text-gray-400 line-through">
                {{ number_format((float) $originalPrice, 2) }} €
            </span>
            @endif
        </div>

        <!-- CTA -->
        @if($canPurchase)
            <div class="flex items-center gap-2 sm:gap-3">
                @if($audioUrl)
                    <button type="button"
                            class="js-card-audio-btn group/play flex-shrink-0 relative p-2 sm:p-3 bg-gradient-to-br from-purple-600 to-blue-600 text-white rounded-full hover:from-purple-700 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-purple-500/25 hover:scale-105 cursor-pointer"
                            data-audio="{{ $audioUrl }}" aria-label="Play">
                        <!-- Effet de pulse en arrière-plan -->
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br from-purple-600 to-blue-600 opacity-75 animate-pulse group-hover/play:opacity-50"></div>
                        
                        <!-- Icônes avec transition fluide -->
                        <div class="relative">
                            <svg class="js-icon-play w-4 h-4 sm:w-5 sm:h-5 transition-all duration-200" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 5v10l7-5z"/>
                            </svg>
                            <svg class="js-icon-pause w-4 h-4 sm:w-5 sm:h-5 hidden transition-all duration-200" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 4h4v12H6zM10 4h4v12h-4z"/>
                            </svg>
                        </div>
                    </button>
                @endif
                <a
                    href="{{ $showUrl }}"
                    class="flex-1 text-center px-4 sm:px-6 py-2.5 sm:py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-[1.02] shadow-md hover:shadow-lg text-sm sm:text-base"
                >
                    {{ __('common.Voir le produit') }}
                </a>
            </div>
        @else
            <button
                disabled
                class="block w-full text-center px-4 py-2.5 sm:py-3 bg-gray-700 text-gray-400 font-semibold rounded-full cursor-not-allowed opacity-60 text-sm sm:text-base"
            >
                {{ __('common.Indisponible') }}
            </button>
        @endif
    </div>
</div>

<!-- Aucun JS inline; la logique est gérée globalement dans app.js -->
