<x-app-layout>
    <x-slot name="title">{{ __('checkout.Paiement') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- En-tête avec étapes -->
                <div class="mb-8">
                    <div class="flex items-center justify-center space-x-4 mb-6">
                        <div class="flex items-center text-green-400">
                            <div class="w-8 h-8 bg-green-400 text-gray-900 rounded-full flex items-center justify-center text-sm font-bold">â</div>
                            <span class="ml-2 text-sm font-medium">{{ __('common.Panier') }}</span>
                        </div>
                        <div class="w-12 h-0.5 bg-green-400"></div>
                        <div class="flex items-center text-green-400">
                            <div class="w-8 h-8 bg-green-400 text-gray-900 rounded-full flex items-center justify-center text-sm font-bold">â</div>
                            <span class="ml-2 text-sm font-medium">{{ __('checkout.Informations personnelles') }}</span>
                        </div>
                        <div class="w-12 h-0.5 bg-white"></div>
                        <div class="flex items-center text-white">
                            <div class="w-8 h-8 bg-white text-gray-900 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                            <span class="ml-2 text-sm font-medium">{{ __('checkout.Paiement') }}</span>
                        </div>
                    </div>
                    <h1 class="font-display font-bold text-4xl text-white text-center">{{ __('checkout.Paiement par carte bancaire') }}</h1>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Formulaire de paiement -->
                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-8">
                        <h2 class="font-display font-bold text-2xl text-white mb-6">{{ __('checkout.Informations de paiement') }}</h2>

                        <!-- Messages d'erreur -->
                        <div id="payment-errors" class="hidden mb-4 p-4 bg-red-900/20 border border-red-700 rounded-lg">
                            <p class="text-red-400 text-sm"></p>
                        </div>

                        <!-- Formulaire Stripe -->
                        <form id="payment-form" class="space-y-6">
                            @csrf

                            <!-- Email de confirmation -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Email de confirmation') }}</label>
                                <input type="email" value="{{ $checkoutData['customer']['email'] }}" readonly
                                       class="w-full px-4 py-3 bg-gray-600 border border-gray-600 rounded-lg text-white">
                            </div>

                            <!-- Carte de crédit -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Informations de la carte') }}</label>
                                <!-- Container pour Stripe Elements avec styles spécifiques -->
                                <div id="card-element" class="stripe-card-element">
                                    <!-- Stripe Elements sera injecté ici -->
                                </div>
                            </div>

                            <!-- Sécurité -->
                            <div class="flex items-center space-x-3 p-4 bg-gray-700/50 rounded-lg">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <div>
                                    <p class="text-white font-medium text-sm">{{ __('checkout.Paiement sécurisé') }}</p>
                                    <p class="text-gray-400 text-xs">{{ __('checkout.Vos informations sont protégées par Stripe') }}</p>
                                </div>
                            </div>

                            <!-- Bouton de paiement -->
                            <button type="submit" id="submit-payment"
                                    class="hover:cursor-pointer w-full bg-white text-gray-900 font-bold py-4 px-6 rounded-full hover:bg-gray-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                <span id="button-text">{{ __('checkout.Payer') }} {{ number_format($summary['total'], 2) }} €</span>
                                <span id="spinner" class="hidden">
                                    <svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>

                            <!-- Informations de sécurité -->
                            <div class="text-center">
                                <div class="flex items-center justify-center space-x-4 mb-2">
                                    <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa" class="h-8">
                                    <img src="https://img.icons8.com/color/48/000000/mastercard.png" alt="Mastercard" class="h-8">
                                    <img src="https://img.icons8.com/color/48/000000/amex.png" alt="Amex" class="h-8">
                                </div>
                                <p class="text-gray-400 text-xs">{{ __('checkout.Paiement sécurisé SSL 256-bit') }}</p>
                            </div>
                        </form>
                    </div>

                    <!-- Récapitulatif de commande -->
                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-8">
                        <h2 class="font-display font-bold text-2xl text-white mb-6">{{ __('checkout.Récapitulatif') }}</h2>

                        <!-- Articles -->
                        <div class="space-y-4 mb-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4 p-4 bg-gray-700 rounded-lg">
                                    <div class="w-12 h-12 bg-gray-600 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item['image_url'])
                                            <img src="https://www.soundtags.fr/public/images/products/{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-medium truncate">{{ $item['name'] }}</p>
                                        <p class="text-gray-400 text-sm">{{ __('common.Quantité:') }} {{ $item['quantity'] }}</p>
                                    </div>
                                    <p class="text-white font-bold">{{ number_format($item['subtotal'], 2) }} €</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Totaux -->
                        <div class="space-y-3 border-t border-gray-600 pt-6">
                            <div class="flex justify-between text-gray-400">
                                <span>{{ __('common.Sous-total') }}</span>
                                <span>{{ number_format($summary['subtotal'], 2) }} €</span>
                            </div>
                            <hr class="border-gray-600">
                            <div class="flex justify-between text-white font-bold text-xl">
                                <span>{{ __('common.Total') }}</span>
                                <span>{{ number_format($summary['total'], 2) }} €</span>
                            </div>
                        </div>

                        <!-- Adresses -->
                        <div class="mt-6 pt-6 border-t border-gray-600 space-y-4">
                            <div>
                                <h4 class="text-white font-medium mb-2">{{ __('checkout.Adresse de livraison') }}</h4>
                                <p class="text-gray-400 text-sm">
                                    {{ $checkoutData['customer']['first_name'] }} {{ $checkoutData['customer']['last_name'] }}<br>
                                    {{ $checkoutData['shipping_address']['address'] }}<br>
                                    {{ $checkoutData['shipping_address']['postal_code'] }} {{ $checkoutData['shipping_address']['city'] }}<br>
                                    {{ $checkoutData['shipping_address']['country'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS pour Stripe Elements -->
    <style>
        .stripe-card-element {
            padding: 16px;
            background-color: #374151;
            border: 1px solid #4B5563;
            border-radius: 8px;
            transition: border-color 0.2s ease;
        }

        .stripe-card-element:focus-within {
            border-color: #6B7280;
            outline: none;
        }

        .stripe-card-element.StripeElement--focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 1px #ffffff;
        }

        .stripe-card-element.StripeElement--invalid {
            border-color: #EF4444;
        }

        .stripe-card-element.StripeElement--complete {
            border-color: #10B981;
        }

        /* Style pour les éléments Stripe */
        .StripeElement {
            height: 40px;
            padding: 10px 12px;
            color: #ffffff;
            background-color: transparent;
            border: none;
            border-radius: 4px;
            box-shadow: none;
        }

        .StripeElement--invalid {
            border-color: #EF4444;
        }

        .StripeElement--webkit-autofill {
            background-color: #374151 !important;
        }
    </style>

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Configuration Stripe avec styles améliorés
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const elements = stripe.elements({
            appearance: {
                theme: 'night',
                variables: {
                    colorPrimary: '#ffffff',
                    colorBackground: '#374151',
                    colorText: '#ffffff',
                    colorDanger: '#ef4444',
                    fontFamily: 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif',
                    fontSizeBase: '16px',
                    spacingUnit: '4px',
                    borderRadius: '8px',
                },
                rules: {
                    '.Input': {
                        backgroundColor: 'transparent',
                        border: 'none',
                        padding: '10px 12px',
                        color: '#ffffff',
                    },
                    '.Input:focus': {
                        outline: 'none',
                        boxShadow: 'none',
                    },
                    '.Input--invalid': {
                        color: '#ef4444',
                    },
                    '.Input::placeholder': {
                        color: '#9CA3AF',
                    }
                }
            }
        });

        // Créer l'élément carte avec options personnalisées
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#ffffff',
                    fontFamily: 'ui-sans-serif, system-ui, sans-serif',
                    '::placeholder': {
                        color: '#9CA3AF',
                    },
                },
                invalid: {
                    color: '#ef4444',
                    iconColor: '#ef4444',
                },
                complete: {
                    color: '#10B981',
                    iconColor: '#10B981',
                }
            },
            hidePostalCode: true,
        });

        cardElement.mount('#card-element');

        // Variables globales
        let clientSecret = null;
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-payment');
        const buttonText = document.getElementById('button-text');
        const spinner = document.getElementById('spinner');
        const errorElement = document.getElementById('payment-errors');

        // Fonction pour afficher les erreurs
        function showError(message) {
            errorElement.querySelector('p').textContent = message;
            errorElement.classList.remove('hidden');
            // Scroll vers l'erreur
            errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function hideError() {
            errorElement.classList.add('hidden');
        }

        // Fonction pour activer/désactiver le bouton
        function setLoading(loading) {
            submitButton.disabled = loading;
            if (loading) {
                buttonText.classList.add('hidden');
                spinner.classList.remove('hidden');
            } else {
                buttonText.classList.remove('hidden');
                spinner.classList.add('hidden');
            }
        }

        // Créer le PaymentIntent au chargement de la page
        async function createPaymentIntent() {
            try {
                const response = await fetch('{{ route("checkout.create-payment-intent") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.error) {
                    throw new Error(data.error);
                }

                clientSecret = data.clientSecret;
                console.log('PaymentIntent créé avec succès');
            } catch (error) {
                console.error('Erreur PaymentIntent:', error);
                showError('Erreur lors de l\'initialisation du paiement: ' + error.message);
            }
        }

        // Gestion de la soumission du formulaire
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            if (!clientSecret) {
                showError('PaymentIntent non initialisé');
                return;
            }

            hideError();
            setLoading(true);

            try {
                const {error, paymentIntent} = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: '{{ $checkoutData["customer"]["first_name"] }} {{ $checkoutData["customer"]["last_name"] }}',
                            email: '{{ $checkoutData["customer"]["email"] }}',
                            phone: '{{ $checkoutData["customer"]["phone"] }}',
                            address: {
                                line1: '{{ $checkoutData["billing_address"]["address"] }}',
                                city: '{{ $checkoutData["billing_address"]["city"] }}',
                                postal_code: '{{ $checkoutData["billing_address"]["postal_code"] }}',
                                country: 'FR'
                            }
                        }
                    }
                });

                if (error) {
                    throw new Error(error.message);
                }

                if (paymentIntent.status === 'succeeded') {
                    // Confirmer la commande côté serveur
                    const response = await fetch('{{ route("checkout.confirm-payment") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        window.location.href = result.redirect;
                    } else {
                        throw new Error(result.error);
                    }
                }
            } catch (error) {
                console.error('Erreur paiement:', error);
                showError(error.message);
                setLoading(false);
            }
        });

        // Initialiser le PaymentIntent au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            createPaymentIntent();
        });

        // Gestion des changements sur la carte
        cardElement.on('change', ({error}) => {
            if (error) {
                showError(error.message);
            } else {
                hideError();
            }
        });

        // Gérer le focus sur l'élément carte
        cardElement.on('focus', () => {
            document.getElementById('card-element').classList.add('StripeElement--focus');
        });

        cardElement.on('blur', () => {
            document.getElementById('card-element').classList.remove('StripeElement--focus');
        });
    </script>
</x-app-layout>