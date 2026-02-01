<x-app-layout>
    <x-slot name="title">{{ $pack->name }} - {{ __('packs.Personnalisez votre pack') }}</x-slot>
    <x-slot name="metaDescription">{{ $pack->meta_description }}</x-slot>

    <div x-data="packConfigurator()" class="min-h-screen bg-gray-900">

        <!-- Header -->
        <section class="bg-gray-800 border-b border-gray-700">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
                <div class="max-w-6xl mx-auto">
                    <nav class="flex text-sm mb-4 sm:mb-6" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">{{ __('common.Accueil') }}</a></li>
                            <li><span class="text-gray-600 mx-2">/</span></li>
                            <li><a href="{{ route('packs.index') }}" class="text-gray-400 hover:text-white transition-colors">{{ __('common.Packs') }}</a></li>
                            <li><span class="text-gray-600 mx-2">/</span></li>
                            <li><span class="text-gray-300">{{ $pack->name }}</span></li>
                        </ol>
                    </nav>

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 sm:gap-6">
                        <div class="flex-1">
                            <h1 class="font-display font-bold text-xl sm:text-2xl lg:text-3xl xl:text-4xl text-white mb-2 sm:mb-3 lg:mb-4">{{ $pack->name }}</h1>
                            <p class="text-base sm:text-lg lg:text-xl text-gray-300 mb-3 sm:mb-4 lg:mb-6">{{ $pack->short_description }}</p>

                            <!-- Progress -->
                            <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center text-gray-400 text-xs sm:text-sm sm:text-base">
                                    <span x-text="getTotalSelectedCount()">0</span>
                                    <span class="mx-1">/</span>
                                    <span>{{ $pack->pack_size }}</span>
                                    <span class="ml-2 hidden sm:inline">{{ __('packs.sound tags sélectionnés') }}</span>
                                    <span class="ml-2 sm:hidden">{{ __('packs.sélectionnés') }}</span>
                                </div>

                                <!-- Progress bar -->
                                <div class="flex-1 max-w-xs bg-gray-700 rounded-full h-2">
                                    <div class="bg-white h-2 rounded-full transition-all duration-300"
                                         :style="`width: ${(getTotalSelectedCount() / {{ $pack->pack_size }}) * 100}%`"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Prix et CTA -->
                        <div class="lg:text-right lg:flex-shrink-0">
                            <div class="flex flex-col sm:flex-row lg:flex-col items-start sm:items-center lg:items-end space-y-2 sm:space-y-0 sm:space-x-3 lg:space-x-0 lg:space-y-2 mb-3 sm:mb-4">
                                <span class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">{{ number_format($pack->price, 2) }} €</span>
                                @if($pack->original_price)
                                    <span class="text-base sm:text-lg lg:text-xl text-gray-400 line-through">{{ number_format($pack->original_price, 2) }} €</span>
                                @endif
                            </div>

                            <button @click="addPackToCart"
                                    :disabled="getTotalSelectedCount() !== {{ $pack->pack_size }} || isLoading"
                                    class="hover:cursor-pointer w-full sm:w-auto px-4 sm:px-6 lg:px-8 py-2.5 sm:py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none text-sm sm:text-base">
                                <span x-show="!isLoading">
                                    {{ __('common.Ajouter au panier') }}
                                </span>
                                <span x-show="isLoading" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('common.Ajout...') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
            <div class="max-w-6xl mx-auto grid grid-cols-1 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">

                <!-- Sound Tags Grid -->
                <div class="xl:col-span-3 order-last xl:order-first">
                    <div class="mb-4 sm:mb-6 lg:mb-8">
                        <h2 class="font-display font-bold text-lg sm:text-xl lg:text-2xl text-white mb-2">
                            {{ __('packs.Choisissez vos sound tags') }}
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-400">
                            {{ __('packs.(Cliquez plusieurs fois pour sélectionner le même tag)') }}
                        </p>
                    </div>

                    <!-- Tags Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
                        @foreach($soundTags as $tag)
                            <div x-show="matchesSearch({{ json_encode($tag->name) }})"
                                 class="bg-gray-800 rounded-xl sm:rounded-2xl border-2 transition-all duration-200 cursor-pointer transform hover:scale-105 relative"
                                 :class="getTagCount({{ $tag->id }}) > 0 ? 'border-white shadow-lg' : 'border-gray-700 hover:border-gray-600'"
                                 @click="addTag({{ $tag->id }})">

                                <!-- Image -->
                                <div class="aspect-square rounded-t-xl sm:rounded-t-2xl overflow-hidden bg-gray-700 relative">
                                    @if($tag->image)
                                        <img src="https://www.soundtags.fr/public/images/products/{{ $tag->image }}"
                                             alt="{{ $tag->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Selection overlay -->
                                    <div x-show="getTagCount({{ $tag->id }}) > 0"
                                         class="absolute inset-0 bg-white/20 flex items-center justify-center">
                                        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-white rounded-full flex items-center justify-center">
                                            <span class="text-black font-bold text-xs sm:text-sm" x-text="getTagCount({{ $tag->id }})"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="p-2 sm:p-3 lg:p-4">
                                    <h3 class="font-semibold text-white text-xs sm:text-sm lg:text-base mb-2 line-clamp-2">
                                        {{ $tag->name }}
                                    </h3>

                                    <!-- Audio duration -->
                                    @if($tag->audio_duration)
                                        <div class="flex items-center text-gray-400 text-xs sm:text-sm">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                            </svg>
                                            {{ $tag->audio_duration }}s
                                        </div>
                                    @endif

                                    <!-- Selection count -->
                                    <div x-show="getTagCount({{ $tag->id }}) > 0"
                                         class="mt-2 inline-flex items-center bg-white text-black text-xs sm:text-sm font-bold px-2 py-1 rounded-full">
                                        <span x-text="getTagCount({{ $tag->id }})"></span>
                                        <span class="ml-1 hidden sm:inline">{{ __('common.sélectionné(s)') }}</span>
                                        <span class="ml-1 sm:hidden">{{ __('common.x') }}</span>
                                    </div>
                                </div>

                                <!-- Bouton pour retirer (visible au survol et toujours sur mobile) -->
                                <button x-show="getTagCount({{ $tag->id }}) > 0"
                                        @click.stop="removeOneTag({{ $tag->id }})"
                                        class="absolute top-2 right-2 w-6 h-6 sm:w-7 sm:h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center opacity-100 sm:opacity-0 sm:hover:opacity-100 transition-opacity shadow-lg">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar - Sélection actuelle -->
                <div class="xl:col-span-1 order-first xl:order-last">
                    <div class="bg-gray-800 rounded-xl sm:rounded-2xl border border-gray-700 p-3 sm:p-4 lg:p-6 xl:sticky xl:top-8">
                        <h3 class="font-display font-bold text-base sm:text-lg lg:text-xl text-white mb-3 sm:mb-4 lg:mb-6">
                            {{ __('packs.Votre sélection') }}
                        </h3>

                        <!-- Progress -->
                        <div class="mb-4 sm:mb-6">
                            <div class="flex justify-between text-xs sm:text-sm text-gray-400 mb-2">
                                <span>{{ __('packs.Progression') }}</span>
                                <span><span x-text="getTotalSelectedCount()">0</span>/{{ $pack->pack_size }}</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-white h-2 rounded-full transition-all duration-300"
                                     :style="`width: ${(getTotalSelectedCount() / {{ $pack->pack_size }}) * 100}%`"></div>
                            </div>
                        </div>

                        <!-- Selected tags list -->
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6 max-h-48 sm:max-h-64 overflow-y-auto">
                            <template x-for="[tagId, count] in Object.entries(selectedTags).filter(([id, count]) => count > 0)" :key="tagId">
                                <div class="flex items-center justify-between bg-gray-700 rounded-lg p-2 sm:p-3">
                                    <div class="flex-1 min-w-0">
                                        <span class="text-white text-xs sm:text-sm font-medium truncate" x-text="getTagName(parseInt(tagId))"></span>
                                        <div class="text-xs text-gray-400" x-show="count > 1">
                                            <span x-text="count"></span> {{ __('common.exemplaires') }}
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <button @click="removeOneTag(parseInt(tagId))"
                                                class="text-red-400 hover:text-red-300 transition-colors p-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                        <button @click="removeAllTag(parseInt(tagId))"
                                                class="text-red-400 hover:text-red-300 transition-colors p-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <div x-show="getTotalSelectedCount() === 0" class="text-center text-gray-400 py-6 sm:py-8">
                                <svg class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2 sm:mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 011-1h1m0 0a2 2 0 011 1v1M9 7h1"/>
                                </svg>
                                <p class="text-xs sm:text-sm">{{ __('packs.Aucun sound tag sélectionné') }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-2 sm:space-y-3">
                            <button @click="clearSelection"
                                    x-show="getTotalSelectedCount() > 0"
                                    class="w-full px-3 sm:px-4 py-2 text-xs sm:text-sm text-gray-400 hover:text-white border border-gray-600 hover:border-gray-500 rounded-lg transition-colors">
                                {{ __('packs.Tout effacer') }}
                            </button>

                            <!-- Final CTA -->
                            <div x-show="getTotalSelectedCount() === {{ $pack->pack_size }}">
                                <div class="bg-green-900/20 border border-green-700 rounded-lg p-3 sm:p-4 text-center">
                                    <div class="text-green-400 font-medium mb-2 text-xs sm:text-sm">
                                        {{ __('packs.Sélection complète !') }}
                                    </div>
                                    <button @click="addPackToCart"
                                            :disabled="isLoading"
                                            class="w-full px-3 sm:px-4 py-2 sm:py-3 bg-white text-black font-semibold rounded-lg hover:bg-gray-100 transition-all duration-200 disabled:opacity-50 text-xs sm:text-sm sm:text-base">
                                        <span x-show="!isLoading">{{ __('common.Ajouter au panier') }}</span>
                                        <span x-show="isLoading">{{ __('common.Ajout...') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div x-show="message" x-transition
             class="fixed bottom-4 right-4 max-w-sm sm:max-w-md p-3 sm:p-4 rounded-lg shadow-lg z-50"
             :class="messageType === 'success' ? 'bg-green-900 border border-green-700 text-green-300' : 'bg-red-900 border border-red-700 text-red-300'">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path x-show="messageType === 'success'" fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    <path x-show="messageType === 'error'" fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <p class="text-xs sm:text-sm" x-text="message"></p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function packConfigurator() {
            const soundTags = @json($soundTags->keyBy('id'));

            return {
                selectedTags: {}, // Objet qui stocke tagId: count
                searchQuery: '',
                isLoading: false,
                message: '',
                messageType: 'success',
                maxTags: {{ $pack->pack_size }},

                addTag(tagId) {
                    // Vérifier si on peut encore ajouter des tags
                    if (this.getTotalSelectedCount() >= this.maxTags) {
                        this.showMessage('{{ __("packs.Vous avez déjà sélectionné le maximum de sound tags pour ce pack.") }}', 'error');
                        return;
                    }

                    // Ajouter ou incrémenter le count
                    if (!this.selectedTags[tagId]) {
                        this.selectedTags[tagId] = 0;
                    }
                    this.selectedTags[tagId]++;
                },

                removeOneTag(tagId) {
                    if (this.selectedTags[tagId] && this.selectedTags[tagId] > 0) {
                        this.selectedTags[tagId]--;
                        if (this.selectedTags[tagId] === 0) {
                            delete this.selectedTags[tagId];
                        }
                    }
                },

                removeAllTag(tagId) {
                    delete this.selectedTags[tagId];
                },

                getTagCount(tagId) {
                    return this.selectedTags[tagId] || 0;
                },

                getTotalSelectedCount() {
                    return Object.values(this.selectedTags).reduce((sum, count) => sum + count, 0);
                },

                getTagName(tagId) {
                    return soundTags[tagId]?.name || '{{ __("common.Tag inconnu") }}';
                },

                matchesSearch(tagName) {
                    if (!this.searchQuery) return true;
                    return tagName.toLowerCase().includes(this.searchQuery.toLowerCase());
                },

                clearSelection() {
                    this.selectedTags = {};
                },

                async addPackToCart() {
                    if (this.getTotalSelectedCount() !== this.maxTags) {
                        const message = '{{ __("packs.Veuillez sélectionner exactement :count sound tags.") }}';
                        this.showMessage(message.replace(':count', this.maxTags), 'error');
                        return;
                    }

                    this.isLoading = true;

                    try {
                        // Convertir l'objet selectedTags en array pour le backend
                        const selectedTagsArray = [];
                        Object.entries(this.selectedTags).forEach(([tagId, count]) => {
                            for (let i = 0; i < count; i++) {
                                selectedTagsArray.push(parseInt(tagId));
                            }
                        });

                        const response = await fetch(`/packs/{{ $pack->slug }}/add-to-cart`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                selected_tags: selectedTagsArray,
                                quantity: 1
                            })
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.showMessage(result.message, 'success');

                            // Update cart count if function exists
                            if (window.updateCartCount) {
                                window.updateCartCount(result.cartCount);
                            }

                            // Redirect to cart after 2 seconds
                            setTimeout(() => {
                                window.location.href = '/cart';
                            }, 2000);
                        } else {
                            this.showMessage(result.message || '{{ __("common.Une erreur est survenue.") }}', 'error');
                        }
                    } catch (error) {
                        this.showMessage('{{ __("common.Une erreur est survenue lors de l\'ajout au panier.") }}', 'error');
                        console.error('Erreur:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },

                showMessage(msg, type = 'success') {
                    this.message = msg;
                    this.messageType = type;
                    setTimeout(() => {
                        this.message = '';
                    }, 5000);
                }
            }
        }
    </script>
</x-app-layout>
