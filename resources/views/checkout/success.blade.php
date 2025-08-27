<x-app-layout>
    <x-slot name="title">{{ __('Commande confirmée') }} - Sound Tags</x-slot>
    <x-slot name="metaDescription">{{ __('Votre commande Sound Tags a été confirmée. Merci pour votre achat !') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Animation de succès -->
            <div class="text-center mb-12">
                <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <h1 class="font-display font-bold text-4xl text-white mb-4">
                    {{ __('Commande confirmée !') }}
                </h1>

                <p class="text-xl text-gray-300 mb-2">
                    {{ __('Merci pour votre achat') }}
                    @if(is_array($order->customer_data) && isset($order->customer_data['first_name']))
                        {{ $order->customer_data['first_name'] }}
                    @endif
                    !
                </p>

                <p class="text-gray-400">
                    {{ __('Numéro de commande :') }}
                    <span class="font-mono text-white bg-gray-800 px-3 py-1 rounded">{{ $order->order_number }}</span>
                </p>
            </div>

            <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Détails de la commande -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <h2 class="font-display font-bold text-xl text-white mb-6">
                        {{ __('Détails de votre commande') }}
                    </h2>

                    <!-- Articles commandés -->
                    <div class="space-y-4 mb-6">
                        @php
                            $cartData = $order->cart_data;
                            if (is_string($cartData)) {
                                $cartData = json_decode($cartData, true) ?? [];
                            }
                        @endphp

                        @if(is_array($cartData) && count($cartData) > 0)
                            @foreach($cartData as $item)
                                <div class="flex items-center space-x-4 p-4 bg-gray-700 rounded-lg">
                                    <div class="w-16 h-16 bg-gray-600 rounded-lg overflow-hidden flex-shrink-0">
                                        @if(isset($item['image_url']) && $item['image_url'])
                                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] ?? '' }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-white font-medium">{{ $item['name'] ?? 'Produit' }}</h4>
                                        <p class="text-gray-400 text-sm">{{ __('Quantité :') }} {{ $item['quantity'] ?? 1 }}</p>
                                        <p class="text-white font-semibold">{{ number_format($item['subtotal'] ?? ($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }} €</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-gray-400 text-center py-4">
                                {{ __('Aucun article trouvé') }}
                            </div>
                        @endif
                    </div>

                    <!-- Récapitulatif des prix -->
                    <div class="space-y-2 pt-4 border-t border-gray-600">
                        @php
                            $summaryData = $order->summary_data;
                            if (is_string($summaryData)) {
                                $summaryData = json_decode($summaryData, true) ?? [];
                            }
                        @endphp

                        <div class="flex justify-between text-gray-400">
                            <span>{{ __('Sous-total') }}</span>
                            <span>{{ number_format($summaryData['subtotal'] ?? 0, 2) }} €</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>{{ __('Livraison') }}</span>
                            <span>{{ ($summaryData['shipping_cost'] ?? 0) > 0 ? number_format($summaryData['shipping_cost'], 2) . ' €' : 'Gratuite' }}</span>
                        </div>
                        <div class="flex justify-between font-semibold text-white text-lg pt-2 border-t border-gray-600">
                            <span>{{ __('Total') }}</span>
                            <span>{{ number_format($order->amount, 2) }} €</span>
                        </div>
                    </div>
                </div>

                <!-- Informations de livraison -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <h2 class="font-display font-bold text-xl text-white mb-6">
                        {{ __('Informations de livraison') }}
                    </h2>

                    <!-- Adresse -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-white mb-2">{{ __('Adresse de livraison') }}</h3>
                        @php
                            $customerData = $order->customer_data;
                            if (is_string($customerData)) {
                                $customerData = json_decode($customerData, true) ?? [];
                            }

                            $shippingAddress = $order->shipping_address;
                            if (is_string($shippingAddress)) {
                                $shippingAddress = json_decode($shippingAddress, true) ?? [];
                            }
                        @endphp

                        <div class="text-gray-300 space-y-1">
                            @if(is_array($customerData))
                                <p>{{ ($customerData['first_name'] ?? '') }} {{ ($customerData['last_name'] ?? '') }}</p>
                            @endif
                            @if(is_array($shippingAddress))
                                <p>{{ $shippingAddress['address'] ?? '' }}</p>
                                <p>{{ ($shippingAddress['postal_code'] ?? '') }} {{ ($shippingAddress['city'] ?? '') }}</p>
                                <p>{{ $shippingAddress['country'] ?? '' }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Mode de livraison -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-white mb-2">{{ __('Mode de livraison') }}</h3>
                        <div class="flex items-center space-x-2 text-gray-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h1.586a1 1 0 01.707.293l1.414 1.414a1 1 0 00.707.293H15a2 2 0 012 2v2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V10m0 0V8a2 2 0 00-2-2H9m0 0V4a2 2 0 00-2-2H5a2 2 0 00-2 2v2m0 0h2"/>
                            </svg>
                            <span>{{ __('Livraison standard (3-5 jours)') }}</span>
                        </div>
                    </div>

                    <!-- Suivi -->
                    <div class="p-4 bg-blue-900/20 border border-blue-700 rounded-lg">
                        <div class="flex items-center space-x-2 text-blue-400 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">{{ __('Suivi de commande') }}</span>
                        </div>
                        <p class="text-blue-300 text-sm">
                            {{ __('Vous recevrez un email de confirmation avec un lien de suivi dès que votre commande sera expédiée.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="text-center mt-12 space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    {{ __('Continuer mes achats') }}
                </a>

                <button onclick="window.print()"
                        class="inline-flex items-center px-8 py-4 border-2 border-gray-600 text-gray-300 font-semibold rounded-full hover:border-gray-500 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    {{ __('Imprimer la commande') }}
                </button>
            </div>

            <!-- Confirmation par email -->
            <div class="max-w-2xl mx-auto mt-12 p-6 bg-gray-800 rounded-2xl border border-gray-700 text-center">
                <div class="flex items-center justify-center space-x-2 text-green-400 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-medium">{{ __('Confirmation envoyée') }}</span>
                </div>
                <p class="text-gray-300">
                    {{ __('Un email de confirmation a été envoyé à') }}
                    <span class="font-mono text-white">{{ $order->customer_email }}</span>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
