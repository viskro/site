@props(['product'])

<div x-data="addToCartForm()" class="space-y-6">

    <!-- Quantité -->
    <div class="flex items-center space-x-4">
        <label class="text-gray-300 font-medium">{{ __('common.Quantité') }}</label>
        <div class="flex items-center border border-gray-600 rounded-lg bg-gray-800">
            <button
                @click="decreaseQuantity"
                class="hover:cursor-pointer p-3 text-gray-400 hover:text-white transition-colors"
                :disabled="quantity <= 1"
                :class="{ 'opacity-50 cursor-not-allowed': quantity <= 1 }"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                </svg>
            </button>

            <input
                x-model="quantity"
                @input="validateQuantity"
                type="number"
                min="1"
                :max="maxQuantity"
                class="w-16 text-center bg-transparent text-white border-0 focus:ring-0 focus:outline-none"
            >

            <button
                @click="increaseQuantity"
                class="hover:cursor-pointer p-3 text-gray-400 hover:text-white transition-colors"
                :disabled="false"
                :class="{}"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </button>
        </div>

        <!-- Stock retiré (illimité) -->
    </div>

    <!-- Prix total -->
    <div class="flex items-center justify-between p-4 bg-gray-800 rounded-lg border border-gray-700">
        <span class="text-gray-300">{{ __('common.Total') }}</span>
        <div class="text-right">
            <div class="text-2xl font-bold text-white" x-text="formatPrice(totalPrice)">
                {{ number_format($product->price, 2) }} €
            </div>
            @if($product->is_on_sale)
                <div class="text-sm text-gray-400 line-through" x-text="formatPrice(originalTotalPrice)">
                    {{ number_format($product->original_price, 2) }} €
                </div>
            @endif
        </div>
    </div>

    <!-- Boutons d'action -->
    <div class="space-y-3">
        @if($product->canBePurchased())
            <!-- Add to Cart -->
            <button
                @click="addToCart"
                :disabled="isLoading || !canAddToCart"
                class="hover:cursor-pointer w-full flex items-center justify-center px-8 py-4 text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                :class="justAdded ? 'bg-green-400 text-white hover:bg-green-600' : 'bg-white'"
            >
                <!-- Loading spinner -->
                <svg x-show="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                <!-- Icon -->
                <svg x-show="!isLoading && !justAdded" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z"/>
                </svg>

                <!-- Success icon -->
                <svg x-show="justAdded" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>

                <span x-text="buttonText">{{ __('common.Ajouter au panier') }}</span>
            </button>

        @else
            <!-- Rupture de stock -->
            <div class="w-full p-4 bg-red-900/20 border border-red-700 rounded-lg text-center">
                <div class="flex items-center justify-center space-x-2 text-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <span class="font-medium">{{ __('common.Produit temporairement indisponible') }}</span>
                </div>
                <p class="text-red-300 text-sm mt-2">{{ __('common.Nous travaillons à remettre ce produit en stock très bientôt.') }}</p>
            </div>

            <!-- Notification de retour en stock -->
            <button class="w-full flex items-center justify-center px-8 py-4 border-2 border-gray-600 text-gray-300 font-semibold rounded-full hover:border-gray-500 hover:text-white transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                {{ __('common.Être notifié du retour en stock') }}
            </button>
        @endif
    </div>

    <!-- Messages -->
    <div x-show="message" x-transition class="p-4 rounded-lg" :class="messageType === 'success' ? 'bg-green-900/50 border border-green-700 text-green-300' : 'bg-red-900/50 border border-red-700 text-red-300'">
        <p x-text="message"></p>
    </div>
</div>

<script>
    function addToCartForm() {
        return {
            productId: {{ $product->id }},
            productName: '{{ addslashes($product->name) }}',
            productPrice: {{ $product->price }},
            originalPrice: {{ $product->original_price ?? $product->price }},
            quantity: 1,
            maxQuantity: 9999,
            isLoading: false,
            justAdded: false,
            message: '',
            messageType: 'success',

            get totalPrice() {
                return this.productPrice * this.quantity;
            },

            get originalTotalPrice() {
                return this.originalPrice * this.quantity;
            },

            get canAddToCart() {
                return this.quantity > 0;
            },

            get buttonText() {
                if (this.justAdded) return '{{ __("common.Ajouté !") }}';
                if (this.isLoading) return '{{ __("common.Ajout en cours...") }}';
                return '{{ __("common.Ajouter au panier") }}';
            },

            increaseQuantity() {
                this.quantity++;
            },

            decreaseQuantity() {
                if (this.quantity > 1) {
                    this.quantity--;
                }
            },

            validateQuantity() {
                if (this.quantity < 1) this.quantity = 1;
            },

            formatPrice(price) {
                return new Intl.NumberFormat('fr-FR', {
                    style: 'currency',
                    currency: 'EUR'
                }).format(price);
            },

            async addToCart() {
                if (!this.canAddToCart || this.isLoading) return;

                this.isLoading = true;
                this.message = '';

                try {
                    const response = await fetch(`/cart/add/${this.productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            quantity: this.quantity
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        this.justAdded = true;
                        this.message = result.message;
                        this.messageType = 'success';

                        // Mettre à jour le compteur du panier dans le header si il existe
                        if (window.updateCartCount) {
                            window.updateCartCount(result.cartCount);
                        }

                        // Reset après 3 secondes
                        setTimeout(() => {
                            this.justAdded = false;
                            this.message = '';
                        }, 3000);

                    } else {
                        this.message = result.message || '{{ __("common.Une erreur est survenue.") }}';
                        this.messageType = 'error';
                    }

                } catch (error) {
                    this.message = '{{ __("common.Une erreur est survenue lors de l\'ajout au panier.") }}';
                    this.messageType = 'error';
                    console.error('Erreur:', error);
                } finally {
                    this.isLoading = false;
                }
            }
        }
    }
</script>
