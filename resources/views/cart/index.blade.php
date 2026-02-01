<x-app-layout>
    <x-slot name="title">{{ __('cart.Mon Panier') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- En-tête -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 sm:mb-8 gap-2">
                    <h1 class="font-display font-bold text-2xl sm:text-3xl lg:text-4xl text-white">{{ __('cart.Mon Panier') }}</h1>
                    @if(!$cartItems->isEmpty())
                        <div class="text-gray-400 text-sm sm:text-base">
                            {{ $cartItems->sum('quantity') }} {{ __('common.article(s)') }}
                        </div>
                    @endif
                </div>

                @if($cartItems->isEmpty())
                    <!-- Panier vide -->
                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-12 text-center">
                        <div class="w-24 h-24 mx-auto mb-6 text-gray-500">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h-.9m0 0L3 3m2 4h16M9 21a2 2 0 100-4 2 2 0 000 4zm7 0a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-4">{{ __('cart.Votre panier est vide') }}</h2>
                        <p class="text-gray-400 mb-8">{{ __('cart.Découvrez nos sound tags et packs pour commencer vos achats !') }}</p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
                            <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-colors">
                                {{ __('cart.Voir les Sound Tags') }}
                            </a>
                            <a href="{{ route('packs.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-600 text-white font-semibold rounded-full hover:border-gray-500 transition-colors">
                                {{ __('cart.Voir les Packs') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Articles du panier -->
                        <div class="lg:col-span-2 space-y-6">
                            @foreach($cartItems as $item)
                                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 hover:border-gray-600 transition-colors cart-item" data-product-id="{{ $item['id'] }}">
                                    <div class="flex flex-col sm:flex-row gap-6">
                                        @if($item['product_type'] == "sound-tag")
                                            <!-- Image produit -->
                                            <div class="flex-shrink-0">
                                                <div class="w-24 h-24 bg-gray-700 rounded-xl overflow-hidden">
                                                    @if($item['image_url'])
                                                        <img src="https://www.soundtags.fr/public/images/products/{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Détails produit -->
                                        <div class="flex-1 min-w-0 ">
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:gap-4">
                                                <div class="flex-1 min-w-0 mb-4 sm:mb-0">
                                                    <h3 class="font-semibold text-white mb-2">
                                                        <a href="{{ $item['product_url'] }}" class="hover:text-gray-300 transition-colors">
                                                            {{ $item['name'] }}
                                                        </a>
                                                    </h3>

                                                    <!-- Sound Tags du pack (si c'est un pack) -->
                                                    @if($item['product_type'] === 'pack' && !empty($item['selected_tags_details']))
                                                        <div class="mb-4 p-4 bg-gray-700 rounded-lg">
                                                            <h4 class="text-sm font-medium text-gray-300 mb-3">
                                                                {{ __('cart.Sound Tags inclus dans ce pack:') }}
                                                            </h4>

                                                            @php
                                                                $tagCounts = array_count_values($item['selected_tags']);
                                                                $tagDetails = collect($item['selected_tags_details'])->keyBy('id');
                                                            @endphp

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                                @foreach($tagCounts as $tagId => $count)
                                                                    @if(isset($tagDetails[$tagId]))
                                                                        @php $tag = $tagDetails[$tagId]; @endphp
                                                                        <div class="flex items-center space-x-3 bg-gray-600 rounded-lg p-3">
                                                                            <!-- Image du tag -->
                                                                            <div class="w-10 h-10 bg-gray-500 rounded-lg overflow-hidden flex-shrink-0">
                                                                                @if($tag['image'])
                                                                                    <img src="https://www.soundtags.fr/public/images/products/{{ $tag['image'] }}"
                                                                                         alt="{{ $tag['name'] }}"
                                                                                         class="w-full h-full object-cover">
                                                                                @else
                                                                                    <div class="w-full h-full flex items-center justify-center">
                                                                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                                                                        </svg>
                                                                                    </div>
                                                                                @endif
                                                                            </div>

                                                                            <!-- Informations du tag -->
                                                                            <div class="flex-1 min-w-0">
                                                                                <p class="text-white text-sm font-medium truncate">
                                                                                    {{ $tag['name'] }}
                                                                                </p>
                                                                                @if($count > 1)
                                                                                    <p class="text-gray-400 text-xs">
                                                                                        {{ $count }}x {{ __('common.dans ce pack') }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Prix -->
                                                    <div class="flex items-baseline space-x-2">
                                                        <span class="text-xl font-bold text-white">{{ number_format($item['price'], 2) }} €</span>
                                                        @if($item['original_price'] && $item['original_price'] > $item['price'])
                                                            <span class="text-sm text-gray-400 line-through">
                                                                {{ number_format($item['original_price'], 2) }} €
                                                            </span>
                                                            <span class="text-xs font-medium text-green-400">
                                                                -{{ round((($item['original_price'] - $item['price']) / $item['original_price']) * 100) }}%
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Contrôles quantité et suppression -->
                                                <div class="flex items-center space-x-4">
                                                    <!-- Sélecteur quantité -->
                                                    <div class="flex items-center border border-gray-600 rounded-lg bg-gray-700">
                                                        <button onclick="updateQuantity('{{ $item['cart_id'] ?? $item['id'] }}', {{ $item['quantity'] - 1 }})"
                                                                class="p-2 text-gray-400 hover:text-white transition-colors"
                                                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                            </svg>
                                                        </button>

                                                        <span class="px-4 py-2 text-white font-medium min-w-[3rem] text-center quantity-display">
                                                            {{ $item['quantity'] }}
                                                        </span>

                                                        <button onclick="updateQuantity('{{ $item['cart_id'] ?? $item['id'] }}', {{ $item['quantity'] + 1 }})"
                                                                class="p-2 text-gray-400 hover:text-white transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <!-- Bouton supprimer -->
                                                    <button onclick="removeItem('{{ $item['cart_id'] ?? $item['id'] }}')"
                                                            class="p-2 text-red-400 hover:text-red-300 hover:bg-red-900/20 rounded-lg transition-all duration-200"
                                                            title="{{ __('common.Supprimer') }}">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Sous-total -->
                                            <div class="mt-4 pt-4 border-t border-gray-600">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-400">{{ __('common.Sous-total') }}</span>
                                                    <span class="font-semibold text-white item-subtotal">
                                                        {{ number_format($item['subtotal'], 2) }} €
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Récapitulatif -->
                        <div class="lg:col-span-1 order-first lg:order-last">
                            <div class="bg-gray-800 rounded-2xl border border-gray-700 p-4 sm:p-6 lg:sticky lg:top-8">
                                <h2 class="font-display font-bold text-lg sm:text-xl text-white mb-4 sm:mb-6">{{ __('cart.Récapitulatif') }}</h2>

                                <div class="space-y-4 mb-6">
                                    <div class="flex justify-between text-gray-400">
                                        <span>{{ __('common.Sous-total') }}</span>
                                        <span>{{ number_format($cartItems->sum('subtotal'), 2) }} €</span>
                                    </div>
                                    <div class="flex justify-between text-gray-400">
                                        <span>{{ __('common.Livraison') }}</span>
                                        <span class="text-green-400 font-medium">{{ __('common.Gratuite') }}</span>
                                    </div>
                                    @if($cartItems->where('original_price', '>', 0)->count() > 0)
                                        <div class="flex justify-between text-green-400 text-sm">
                                            <span>{{ __('common.Économies') }}</span>
                                            <span>-{{ number_format($cartItems->sum(function($item) {
                                                return $item['original_price'] > $item['price'] ? ($item['original_price'] - $item['price']) * $item['quantity'] : 0;
                                            }), 2) }} €</span>
                                        </div>
                                    @endif
                                    <hr class="border-gray-600">
                                    <div class="flex justify-between text-white font-bold text-lg">
                                        <span>{{ __('common.Total') }}</span>
                                        <span>{{ number_format($cartItems->sum('subtotal'), 2) }} €</span>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <a href="{{ route('checkout.index') }}"
                                       class="w-full block text-center px-6 py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-colors">
                                        {{ __('cart.Procéder au paiement') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript pour les interactions -->
    <script>
        function updateQuantity(itemId, newQuantity) {
            if (newQuantity < 1) return;

            fetch(`/cart/update/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    quantity: newQuantity
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || '{{ __("common.Erreur lors de la mise à jour") }}');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('{{ __("common.Une erreur est survenue lors de la mise à jour du panier") }}');
                });
        }

        function removeItem(itemId) {
            if (!confirm('{{ __("common.Êtes-vous sûr de vouloir supprimer cet article ?") }}')) return;

            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || '{{ __("common.Erreur lors de la suppression") }}');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('{{ __("common.Une erreur est survenue lors de la suppression de l\'article") }}');
                });
        }
    </script>
</x-app-layout>
