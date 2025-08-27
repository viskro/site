<x-app-layout>
    <x-slot name="title">{{ __('Packs Sound Tags - Économisez jusqu\'à 35%') }}</x-slot>
    <x-slot name="metaDescription">{{ __('Découvrez nos packs Sound Tags personnalisables. Choisissez vos sound tags préférés et économisez jusqu\'à 35% !') }}</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="font-display font-bold text-5xl lg:text-6xl text-white mb-6">
                    {{ __('Packs Sound Tags') }}
                </h1>
                <p class="text-xl text-gray-300 leading-relaxed mb-8">
                    {{ __('Choisissez vos sound tags préférés et économisez jusqu\'à 35% ! Parfait pour découvrir, offrir ou compléter votre collection.') }}
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">35%</div>
                        <div class="text-gray-400 text-sm">{{ __('Économies max') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">{{ $soundTags->count() }}+</div>
                        <div class="text-gray-400 text-sm">{{ __('Sound tags au choix') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">48h</div>
                        <div class="text-gray-400 text-sm">{{ __('Livraison rapide') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packs Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($packs as $pack)
                    <div class="bg-gray-800 rounded-3xl border border-gray-700 overflow-hidden transform hover:scale-105 transition-all duration-300 group">
                        <!-- Header du pack -->
                        <div class="p-8 text-center relative">
                            @if($pack->pack_size === 6)
                                <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    {{ __('POPULAIRE') }}
                                </div>
                            @elseif($pack->pack_size === 10)
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-black text-xs font-bold px-3 py-1 rounded-full">
                                    {{ __('PREMIUM') }}
                                </div>
                            @endif

                            <!-- Icon -->
                            <div class="w-20 h-20 bg-gradient-to-br from-white to-gray-300 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:from-yellow-400 group-hover:to-orange-500 transition-all duration-300">
                                <span class="text-2xl font-bold text-black">{{ $pack->pack_size }}</span>
                            </div>

                            <h3 class="font-display font-bold text-2xl text-white mb-4">
                                {{ $pack->name }}
                            </h3>

                            <p class="text-gray-400 mb-6 leading-relaxed">
                                {{ $pack->short_description }}
                            </p>

                            <!-- Prix -->
                            <div class="mb-6">
                                <div class="flex items-center justify-center space-x-3 mb-2">
                                    <span class="text-4xl font-bold text-white">
                                        {{ number_format($pack->price, 2) }} €
                                    </span>
                                    @if($pack->original_price)
                                        <span class="text-xl text-gray-400 line-through">
                                            {{ number_format($pack->original_price, 2) }} €
                                        </span>
                                    @endif
                                </div>

                                @if($pack->original_price)
                                    @php
                                        $savings = round((($pack->original_price - $pack->price) / $pack->original_price) * 100);
                                    @endphp
                                    <div class="inline-flex items-center bg-green-600 text-white text-sm font-medium px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Économisez') }} {{ $savings }}%
                                    </div>
                                @endif
                            </div>

                            <!-- Prix par tag -->
                            <div class="text-sm text-gray-400 mb-6">
                                {{ __('Soit') }} {{ number_format($pack->price / $pack->pack_size, 2) }} € {{ __('par sound tag') }}
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="px-8 pb-8">
                            <ul class="space-y-3 mb-8">
                                <li class="flex items-center text-gray-300">
                                    <svg class="w-5 h-5 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Choix libre parmi tous nos tags') }}
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <svg class="w-5 h-5 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Livraison gratuite') }}
                                </li>
                                <li class="flex items-center text-gray-300">
                                    <svg class="w-5 h-5 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Support technique inclus') }}
                                </li>
                            </ul>

                            <!-- CTA Button -->
                            <a href="{{ route('packs.show', $pack) }}"
                               class="block w-full text-center px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 group-hover:shadow-xl">
                                {{ __('Personnaliser mon pack') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Comment ça marche -->
    <section class="py-16 bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-display font-bold text-3xl text-white mb-4">
                    {{ __('Comment ça marche ?') }}
                </h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    {{ __('Créez votre pack personnalisé en 3 étapes simples') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="w-16 h-16 bg-white text-black rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        1
                    </div>
                    <h3 class="font-semibold text-xl text-white mb-4">
                        {{ __('Choisissez votre pack') }}
                    </h3>
                    <p class="text-gray-400">
                        {{ __('Sélectionnez le nombre de sound tags que vous souhaitez (3, 6 ou 10)') }}
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-white text-black rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        2
                    </div>
                    <h3 class="font-semibold text-xl text-white mb-4">
                        {{ __('Personnalisez') }}
                    </h3>
                    <p class="text-gray-400">
                        {{ __('Choisissez vos sound tags préférés parmi toute notre collection disponible') }}
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-white text-black rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        3
                    </div>
                    <h3 class="font-semibold text-xl text-white mb-4">
                        {{ __('Recevez') }}
                    </h3>
                    <p class="text-gray-400">
                        {{ __('Votre pack personnalisé arrive chez vous sous 48h avec tous les extras inclus') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-display font-bold text-3xl text-white text-center mb-12">
                    {{ __('Questions fréquentes') }}
                </h2>

                <div class="space-y-6">
                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">
                        <h3 class="font-semibold text-lg text-white mb-3">
                            {{ __('Puis-je changer les sound tags après commande ?') }}
                        </h3>
                        <p class="text-gray-400">
                            {{ __('Une fois votre commande validée, les sound tags ne peuvent plus être modifiés car ils sont immédiatement préparés pour l\'expédition. Prenez bien le temps de faire votre sélection !') }}
                        </p>
                    </div>

                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">
                        <h3 class="font-semibold text-lg text-white mb-3">
                            {{ __('Puis-je avoir plusieurs fois le même sound tag dans un pack ?') }}
                        </h3>
                        <p class="text-gray-400">
                            {{ __('Oui, vous pouvez choisir plusieurs fois le même sound tag si vous le souhaitez. Pratique pour offrir ou avoir des doublons de vos favoris !') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
