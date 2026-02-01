<x-app-layout>
    <x-slot name="title">{{ __('checkout.Finaliser ma commande') }} - Sound Tags</x-slot>
    <x-slot name="metaDescription">{{ __('checkout.Finalisez votre commande Sound Tags en toute sécurité. Paiement sécurisé et livraison rapide.') }}</x-slot>

    <div x-data="checkoutManager()" class="min-h-screen bg-gray-900">

        <!-- Header du checkout -->
        <section class="bg-gray-800 border-b border-gray-700">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div>
                        <h1 class="font-display font-bold text-2xl sm:text-3xl text-white mb-2">
                            {{ __('checkout.Finaliser ma commande') }}
                        </h1>
                        <p class="text-gray-400">
                            {{ $summary['items_count'] }} {{ __('checkout.article(s) pour') }} {{ number_format($summary['total'], 2) }} €
                        </p>
                    </div>

                    <!-- Breadcrumb -->
                    <nav class="flex text-sm" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="hidden sm:block">
                                <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">
                                    {{ __('common.Accueil') }}
                                </a>
                            </li>
                            <li class="hidden sm:block">
                                <svg class="w-4 h-4 text-gray-600 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white transition-colors">
                                    {{ __('common.Panier') }}
                                </a>
                            </li>
                            <li class="hidden sm:block">
                                <svg class="w-4 h-4 text-gray-600 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-300">{{ __('checkout.Commande') }}</span>
                            </li>
                            <!-- Version mobile simplifiée -->
                            <li class="sm:hidden">
                                <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white transition-colors">
                                    ← {{ __('checkout.Retour au panier') }}
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <form @submit.prevent="submitOrder" class="flex flex-col lg:grid lg:grid-cols-3 gap-8 lg:gap-12">

                <!-- Résumé de commande - Affiché en premier sur mobile -->
                <div class="lg:col-span-1 order-1 lg:order-2">
                    <div class="bg-gray-800 rounded-2xl p-4 sm:p-6 border border-gray-700 lg:sticky lg:top-8">
                        <h2 class="font-display font-bold text-lg sm:text-xl text-white mb-4 sm:mb-6">
                            {{ __('checkout.Votre commande') }}
                        </h2>

                        <!-- Articles -->
                        <div class="space-y-3 sm:space-y-4 mb-4 sm:mb-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-3 p-2 sm:p-3 bg-gray-700 rounded-lg">
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-600 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item['image_url'])
                                            <img src="https://www.soundtags.fr/public/images/products/{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-white font-medium text-sm truncate">{{ $item['name'] }}</h4>
                                        <p class="text-gray-400 text-xs sm:text-sm">{{ __('common.Qté :') }} {{ $item['quantity'] }}</p>
                                    </div>
                                    <div class="text-white font-semibold text-sm">
                                        {{ number_format($item['subtotal'], 2) }} €
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Totaux -->
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6 pt-3 sm:pt-4 border-t border-gray-600">
                            <div class="flex justify-between text-gray-400 text-sm">
                                <span>{{ __('common.Sous-total') }}</span>
                                <span>{{ number_format($summary['subtotal'], 2) }} €</span>
                            </div>

                            <div class="flex justify-between items-center pt-2 sm:pt-3 border-t border-gray-600">
                                <span class="font-semibold text-white text-base sm:text-lg">{{ __('common.Total') }}</span>
                                <span class="font-bold text-white text-lg sm:text-xl" x-text="totalDisplay">
                                    {{ number_format($summary['total'], 2) }} €
                                </span>
                            </div>
                        </div>

                        <!-- Bouton de commande -->
                        <button type="submit" :disabled="isLoading"
                                class="hover:cursor-pointer w-full flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none text-sm sm:text-base">
                            <!-- Loading spinner -->
                            <svg x-show="isLoading" class="animate-spin -ml-1 mr-3 h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>

                            <span x-text="isLoading ? '{{ __('checkout.Traitement en cours...') }}' : '{{ __('checkout.Finaliser ma commande') }}'">
                                {{ __('checkout.Finaliser ma commande') }}
                            </span>
                        </button>

                        <!-- Garanties -->
                        <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-600">
                            <div class="space-y-2 sm:space-y-3 text-xs sm:text-sm">
                                <div class="flex items-center space-x-2 text-gray-400">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ __('checkout.Paiement 100% sécurisé') }}</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-400">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ __('checkout.Satisfaction garantie') }}</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-400">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ __('checkout.Support client 7j/7') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de commande -->
                <div class="lg:col-span-2 space-y-6 sm:space-y-8 order-2 lg:order-1">

                    <!-- Informations personnelles -->
                    <div class="bg-gray-800 rounded-2xl p-4 sm:p-6 border border-gray-700">
                        <h2 class="font-display font-bold text-lg sm:text-xl text-white mb-4 sm:mb-6 flex items-center">
                            <span class="w-6 h-6 sm:w-8 sm:h-8 bg-white text-black rounded-full flex items-center justify-center text-xs sm:text-sm font-bold mr-2 sm:mr-3">1</span>
                            {{ __('checkout.Informations personnelles') }}
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Prénom') }} *</label>
                                <input x-model="formData.first_name" type="text" required
                                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Nom') }} *</label>
                                <input x-model="formData.last_name" type="text" required
                                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Email') }} *</label>
                                <input x-model="formData.email" type="email" required
                                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Téléphone') }} *</label>
                                <input x-model="formData.phone" type="tel" required
                                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Adresse de livraison -->
                    <div class="bg-gray-800 rounded-2xl p-4 sm:p-6 border border-gray-700">
                        <h2 class="font-display font-bold text-lg sm:text-xl text-white mb-4 sm:mb-6 flex items-center">
                            <span class="w-6 h-6 sm:w-8 sm:h-8 bg-white text-black rounded-full flex items-center justify-center text-xs sm:text-sm font-bold mr-2 sm:mr-3">2</span>
                            {{ __('checkout.Adresse de livraison') }}
                        </h2>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Adresse') }} *</label>
                                <input x-model="formData.shipping_address" type="text" required
                                       placeholder="{{ __('checkout.Numéro et nom de rue') }}"
                                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Ville') }} *</label>
                                    <input x-model="formData.shipping_city" type="text" required
                                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Code postal') }} *</label>
                                    <input x-model="formData.shipping_postal_code" type="text" required
                                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                                </div>
                                <!-- Sélecteur de pays avec une grande liste internationale -->
                                <div>
                                    <label for="shipping_country" class="block text-sm font-medium text-gray-300 mb-2">
                                        {{ __('checkout.Pays') }}
                                    </label>
                                    <select x-model="formData.shipping_country" name="shipping_country" id="shipping_country" required
                                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500">
                                        <option value="">{{ __('checkout.Sélectionnez un pays') }}</option>

                                        <!-- Pays francophones en premier -->
                                        <optgroup label="{{ __('checkout.Pays francophones') }}">
                                            <option value="France">France</option>
                                            <option value="Belgique">Belgique</option>
                                            <option value="Suisse">Suisse</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Canada">Canada</option>
                                        </optgroup>

                                        <!-- Europe -->
                                        <optgroup label="{{ __('checkout.Europe') }}">
                                            <option value="Allemagne">Allemagne</option>
                                            <option value="Andorre">Andorre</option>
                                            <option value="Autriche">Autriche</option>
                                            <option value="Danemark">Danemark</option>
                                            <option value="Espagne">Espagne</option>
                                            <option value="Finlande">Finlande</option>
                                            <option value="Grèce">Grèce</option>
                                            <option value="Irlande">Irlande</option>
                                            <option value="Islande">Islande</option>
                                            <option value="Italie">Italie</option>
                                            <option value="Norvège">Norvège</option>
                                            <option value="Pays-Bas">Pays-Bas</option>
                                            <option value="Pologne">Pologne</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="République tchèque">République tchèque</option>
                                            <option value="Royaume-Uni">Royaume-Uni</option>
                                            <option value="Suède">Suède</option>
                                        </optgroup>

                                        <!-- Amérique -->
                                        <optgroup label="{{ __('checkout.Amérique') }}">
                                            <option value="États-Unis">États-Unis</option>
                                            <option value="Mexique">Mexique</option>
                                            <option value="Argentine">Argentine</option>
                                            <option value="Brésil">Brésil</option>
                                            <option value="Chili">Chili</option>
                                        </optgroup>

                                        <!-- Asie-Pacifique -->
                                        <optgroup label="{{ __('checkout.Asie-Pacifique') }}">
                                            <option value="Australie">Australie</option>
                                            <option value="Japon">Japon</option>
                                            <option value="Nouvelle-Zélande">Nouvelle-Zélande</option>
                                            <option value="Singapour">Singapour</option>
                                            <option value="Corée du Sud">Corée du Sud</option>
                                        </optgroup>

                                        <!-- Autres -->
                                        <optgroup label="{{ __('checkout.Autres') }}">
                                            <option value="Maroc">Maroc</option>
                                            <option value="Tunisie">Tunisie</option>
                                            <option value="Algérie">Algérie</option>
                                            <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                            <option value="Sénégal">Sénégal</option>
                                            <option value="Israël">Israël</option>
                                            <option value="Afrique du Sud">Afrique du Sud</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Adresse de facturation -->
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <h2 class="font-display font-bold text-xl text-white mb-6 flex items-center">
                            <span class="w-8 h-8 bg-white text-black rounded-full flex items-center justify-center text-sm font-bold mr-3">3</span>
                            {{ __('checkout.Adresse de facturation') }}
                        </h2>

                        <div class="space-y-6">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input x-model="formData.billing_same_as_shipping" type="checkbox"
                                       class="w-4 h-4 text-white bg-gray-700 border-gray-600 rounded focus:ring-white focus:ring-2">
                                <span class="text-gray-300">{{ __('checkout.Identique à l\'adresse de livraison') }}</span>
                            </label>

                            <div x-show="!formData.billing_same_as_shipping" x-transition class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Adresse') }} *</label>
                                    <input x-model="formData.billing_address" type="text" :required="!formData.billing_same_as_shipping"
                                           placeholder="{{ __('checkout.Numéro et nom de rue') }}"
                                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Ville') }} *</label>
                                        <input x-model="formData.billing_city" type="text" :required="!formData.billing_same_as_shipping"
                                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Code postal') }} *</label>
                                        <input x-model="formData.billing_postal_code" type="text" :required="!formData.billing_same_as_shipping"
                                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('checkout.Pays') }} *</label>
                                        <select x-model="formData.billing_country" :required="!formData.billing_same_as_shipping"
                                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-white focus:border-transparent transition-all">
                                            <option value="France">France</option>
                                            <option value="Belgique">Belgique</option>
                                            <option value="Suisse">Suisse</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <!-- Conditions générales -->
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="space-y-4">
                            <label class="flex items-start space-x-3 cursor-pointer">
                                <input x-model="formData.terms_accepted" type="checkbox" required
                                       class="w-4 h-4 text-white bg-gray-700 border-gray-600 rounded focus:ring-white focus:ring-2 mt-0.5">
                                <span class="text-gray-300 text-sm">
                                    {{ __('checkout.J\'accepte les') }}
                                    <a href="{{ route('terms') }}" target="_blank" class="text-white hover:underline">{{ __('checkout.conditions générales de vente') }}</a>
                                    {{ __('checkout.et la') }}
                                    <a href="{{ route('privacy') }}" target="_blank" class="text-white hover:underline">{{ __('checkout.politique de confidentialité') }}</a>
                                    *
                                </span>
                            </label>


                        </div>
                    </div>
                </div>


            </form>
        </div>

        <!-- Messages d'erreur -->
        <div x-show="message" x-transition
             class="fixed bottom-4 right-4 max-w-md p-4 bg-red-900 border border-red-700 text-red-300 rounded-lg shadow-lg z-50"
             x-data="{ show: false }"
             @show-message.window="show = true; setTimeout(() => show = false, 5000)">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <p x-text="message"></p>
            </div>
        </div>
    </div>

    <!-- JavaScript pour la gestion du checkout -->
    <script>
        function checkoutManager() {
            return {
                isLoading: false,
                message: '',

                formData: {
                    email: '',
                    first_name: '',
                    last_name: '',
                    phone: '',
                    shipping_address: '',
                    shipping_city: '',
                    shipping_postal_code: '',
                    shipping_country: '',
                    billing_same_as_shipping: true,
                    billing_address: '',
                    billing_city: '',
                    billing_postal_code: '',
                    billing_country: '',

                    terms_accepted: false,

                },

                get totalDisplay() {
                    let total = {{ $summary['total'] }};
                    return new Intl.NumberFormat('fr-FR', {
                        style: 'currency',
                        currency: 'EUR'
                    }).format(total);
                },

                async submitOrder() {
                    if (this.isLoading) return;

                    this.isLoading = true;
                    this.message = '';

                    try {
                        const response = await fetch('/checkout/process', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(this.formData)
                        });

                        const result = await response.json();

                        if (result.success) {
                            // Redirection vers la page de succès
                            window.location.href = result.redirect;
                        } else {
                            this.message = result.message || '{{ __("Une erreur est survenue.") }}';
                            this.$dispatch('show-message');
                        }

                    } catch (error) {
                        this.message = '{{ __("Une erreur est survenue lors du traitement de votre commande.") }}';
                        this.$dispatch('show-message');
                        console.error('Erreur:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>
