<x-app-layout>
    <x-slot name="title">{{ $pack->name }} - Personnalisez votre pack</x-slot>
    <x-slot name="metaDescription">{{ $pack->meta_description }}</x-slot>

    <div x-data="packConfigurator()" class="min-h-screen bg-gray-900">

        <!-- Header -->
        <section class="bg-gray-800 border-b border-gray-700">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="max-w-6xl mx-auto">
                    <nav class="flex text-sm mb-6" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">{{ __('Accueil') }}</a></li>
                            <li><span class="text-gray-600 mx-2">/</span></li>
                            <li><a href="{{ route('packs.index') }}" class="text-gray-400 hover:text-white transition-colors">{{ __('Packs') }}</a></li>
                            <li><span class="text-gray-600 mx-2">/</span></li>
                            <li><span class="text-gray-300">{{ $pack->name }}</span></li>
                        </ol>
                    </nav>

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h1 class="font-display font-bold text-4xl text-white mb-4">{{ $pack->name }}</h1>
                            <p class="text-xl text-gray-300 mb-4">{{ $pack->short_description }}</p>

                            <!-- Progress -->
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center text-gray-400">
                                    <span x-text="getTotalSelectedCount()">0</span>
                                    <span class="mx-1">/</span>
                                    <span>{{ $pack->pack_size }}</span>
                                    <span class="ml-2">{{ __('sound tags sélectionnés') }}</span>
                                </div>

                                <!-- Progress bar -->
                                <div class="flex-1 max-w-xs bg-gray-700 rounded-full h-2">
                                    <div class="bg-white h-2 rounded-full transition-all duration-300"
                                         :style="`width: ${(getTotalSelectedCount() / {{ $pack->pack_size }}) * 100}%`"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Prix et CTA -->
                        <div class="mt-6 lg:mt-0 lg:text-right">
                            <div class="flex items-center lg:justify-end space-x-3 mb-4">
                                <span class="text-3xl font-bold text-white">{{ number_format($pack->price, 2) }} €</span>
                                @if($pack->original_price)
                                    <span class="text-xl text-gray-400 line-through">{{ number_format($pack->original_price, 2) }} €</span>
                                @endif
                            </div>

                            <button @click="addPackToCart"
                                    :disabled="getTotalSelectedCount() !== {{ $pack->pack_size }} || isLoading"
                                    class="hover:cursor-pointer px-8 py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                <span x-show="!isLoading">
                                    {{ __('Ajouter au panier') }}
                                </span>
                                <span x-show="isLoading" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('Ajout...') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-6xl mx-auto grid grid-cols-1 xl:grid-cols-4 gap-8">

                <!-- Sound Tags Grid -->
                <div class="xl:col-span-3">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="font-display font-bold text-2xl text-white">
                            {{ __('Choisissez vos sound tags') }}
                            <span class="text-sm font-normal text-gray-400 ml-2">
                                {{ __('(Cliquez plusieurs fois pour sélectionner le même tag)') }}
                            </span>
                        </h2>

                        <!-- Search -->
                        <div class="relative">
                            <input x-model="searchQuery"
                                   type="text"
                                   placeholder="{{ __('Rechercher...') }}"
                                   class="w-64 px-4 py-2 pl-10 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-white focus:border-transparent">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Tags Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($soundTags as $tag)
                            <div x-show="matchesSearch({{ json_encode($tag->name) }})"
                                 class="bg-gray-800 rounded-2xl border-2 transition-all duration-200 cursor-pointer transform hover:scale-105 relative"
                                 :class="getTagCount({{ $tag->id }}) > 0 ? 'border-white shadow-lg' : 'border-gray-700 hover:border-gray-600'"
                                 @click="addTag({{ $tag->id }})">

                                <!-- Image -->
                                <div class="aspect-square rounded-t-2xl overflow-hidden bg-gray-700 relative">
                                    @if($tag->image)
                                        <img src="{{ asset('storage/images/products/' . $tag->image) }}"
                                             alt="{{ $tag->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Selection overlay -->
                                    <div x-show="getTagCount({{ $tag->id }}) > 0"
                                         class="absolute inset-0 bg-white/20 flex items-center justify-center">
                                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                                            <span class="text-black font-bold text-sm" x-text="getTagCount({{ $tag->id }})"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="p-4">
                                    <h3 class="font-semibold text-white text-sm mb-2 line-clamp-2">
                                        {{ $tag->name }}
                                    </h3>

                                    <!-- Audio duration -->
                                    @if($tag->audio_duration)
                                        <div class="flex items-center text-gray-400 text-xs">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                            </svg>
                                            {{ $tag->audio_duration }}s
                                        </div>
                                    @endif

                                    <!-- Selection count -->
                                    <div x-show="getTagCount({{ $tag->id }}) > 0"
                                         class="mt-2 inline-flex items-center bg-white text-black text-xs font-bold px-2 py-1 rounded-full">
                                        <span x-text="getTagCount({{ $tag->id }})"></span>
                                        <span class="ml-1">{{ __('sélectionné(s)') }}</span>
                                    </div>
                                </div>

                                <!-- Bouton pour retirer (visible au survol) -->
                                <button x-show="getTagCount({{ $tag->id }}) > 0"
                                        @click.stop="removeOneTag({{ $tag->id }})"
                                        class="absolute top-2 right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar - Sélection actuelle -->
                <div class="xl:col-span-1">
                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6 sticky top-8">
                        <h3 class="font-display font-bold text-xl text-white mb-6">
                            {{ __('Votre sélection') }}
                        </h3>

                        <!-- Progress -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm text-gray-400 mb-2">
                                <span>{{ __('Progression') }}</span>
                                <span><span x-text="getTotalSelectedCount()">0</span>/{{ $pack->pack_size }}</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-white h-2 rounded-full transition-all duration-300"
                                     :style="`width: ${(getTotalSelectedCount() / {{ $pack->pack_size }}) * 100}%`"></div>
                            </div>
                        </div>

                        <!-- Selected tags list -->
                        <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                            <template x-for="[tagId, count] in Object.entries(selectedTags).filter(([id, count]) => count > 0)" :key="tagId">
                                <div class="flex items-center justify-between bg-gray-700 rounded-lg p-3">
                                    <div class="flex-1">
                                        <span class="text-white text-sm font-medium" x-text="getTagName(parseInt(tagId))"></span>
                                        <div class="text-xs text-gray-400" x-show="count > 1">
                                            <span x-text="count"></span> exemplaires
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

                            <div x-show="getTotalSelectedCount() === 0" class="text-center text-gray-400 py-8">
                                <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 011-1h1m0 0a2 2 0 011 1v1M9 7h1"/>
                                </svg>
                                <p>{{ __('Aucun sound tag sélectionné') }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-3">
                            <button @click="clearSelection"
                                    x-show="getTotalSelectedCount() > 0"
                                    class="w-full px-4 py-2 text-gray-400 hover:text-white border border-gray-600 hover:border-gray-500 rounded-lg transition-colors">
                                {{ __('Tout effacer') }}
                            </button>

                            <!-- Final CTA -->
                            <div x-show="getTotalSelectedCount() === {{ $pack->pack_size }}">
                                <div class="bg-green-900/20 border border-green-700 rounded-lg p-4 text-center">
                                    <div class="text-green-400 font-medium mb-2">
                                        {{ __('Sélection complète !') }}
                                    </div>
                                    <button @click="addPackToCart"
                                            :disabled="isLoading"
                                            class="w-full px-4 py-3 bg-white text-black font-semibold rounded-lg hover:bg-gray-100 transition-all duration-200 disabled:opacity-50">
                                        <span x-show="!isLoading">{{ __('Ajouter au panier') }}</span>
                                        <span x-show="isLoading">{{ __('Ajout...') }}</span>
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
             class="fixed bottom-4 right-4 max-w-md p-4 rounded-lg shadow-lg z-50"
             :class="messageType === 'success' ? 'bg-green-900 border border-green-700 text-green-300' : 'bg-red-900 border border-red-700 text-red-300'">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path x-show="messageType === 'success'" fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    <path x-show="messageType === 'error'" fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <p x-text="message"></p>
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
                        this.showMessage('Vous avez déjà sélectionné le maximum de sound tags pour ce pack.', 'error');
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
                    return soundTags[tagId]?.name || 'Tag inconnu';
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
                        this.showMessage(`Veuillez sélectionner exactement ${this.maxTags} sound tags.`, 'error');
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
                            this.showMessage(result.message || 'Une erreur est survenue.', 'error');
                        }
                    } catch (error) {
                        this.showMessage('Une erreur est survenue lors de l\'ajout au panier.', 'error');
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
