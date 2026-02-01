@php
    // Représentation générique des tags NFC (sans logos)
@endphp

<x-app-layout>
    <x-slot name="title">{{ __('packs.Packs Sound Tags - Économisez jusqu\'à 35%') }}</x-slot>
    <x-slot name="metaDescription">{{ __('packs.Découvrez nos packs Sound Tags personnalisables. Choisissez vos sound tags préférés et économisez jusqu\'à 35% !') }}</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl xl:text-6xl text-white mb-4 sm:mb-6">
                    {{ __('packs.Packs Sound Tags') }}
                </h1>
                <p class="text-base sm:text-lg lg:text-xl text-gray-300 leading-relaxed mb-6 sm:mb-8">
                    {{ __('packs.Choisissez vos sound tags préférés et économisez jusqu\'à 35% ! Parfait pour découvrir, offrir ou compléter votre collection.') }}
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 sm:gap-6 lg:gap-8 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">35%</div>
                        <div class="text-gray-400 text-xs sm:text-sm">{{ __('packs.Économies max') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">{{ $soundTags->count() }}+</div>
                        <div class="text-gray-400 text-xs sm:text-sm">{{ __('packs.Sound tags au choix') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">â¡</div>
                        <div class="text-gray-400 text-xs sm:text-sm">{{ __('packs.Expédition') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packs Grid -->
    <section class="py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto">
                @foreach($packs as $pack)
                    <div class="bg-gray-800 rounded-2xl sm:rounded-3xl border border-gray-700 overflow-hidden transform hover:scale-105 transition-all duration-300 group">
                        <!-- Header du pack -->
                        <div class="p-4 sm:p-6 lg:p-8 text-center relative">
                            @if($pack->pack_size === 6)
                                <div class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-blue-600 text-white text-xs font-bold px-2 py-1 sm:px-3 sm:py-1 rounded-full">
                                    {{ __('packs.POPULAIRE') }}
                                </div>
                            @elseif($pack->pack_size === 10)
                                <div class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-black text-xs font-bold px-2 py-1 sm:px-3 sm:py-1 rounded-full">
                                    {{ __('packs.PREMIUM') }}
                                </div>
                            @endif

                            <!-- Icon représentatif avec design premium -->
                            <div class="flex items-center justify-center mx-auto mb-4 sm:mb-6 h-16 sm:h-20 lg:h-24 relative">
                                <!-- Arrière-plan décoratif -->
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 via-blue-500/10 to-purple-500/10 rounded-full blur-xl group-hover:from-yellow-400/20 group-hover:to-orange-500/20 transition-all duration-500"></div>
                                
                                @if($pack->pack_size === 3)
                                    <!-- 3 cercles disposés comme sur l'image: 2 qui se chevauchent + 1 petit avec +1 -->
                                    <div class="relative w-16 h-12 sm:w-20 sm:h-16">
                                        <!-- Premier cercle (arrière) -->
                                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-2 left-0 shadow-lg border-2 border-white/50 z-10">
                                        <div class="w-7 h-7 sm:w-11 sm:h-11 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-xs font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <!-- Deuxième cercle (qui chevauche le premier) -->
                                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-2 left-4 sm:left-6 shadow-lg border-2 border-white/50 z-20">
                                        <div class="w-7 h-7 sm:w-11 sm:h-11 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-xs font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <!-- Petit cercle +1 par-dessus -->
                                        <div class="w-5 h-5 sm:w-7 sm:h-7 bg-gradient-to-br from-gray-700 via-gray-800 to-black rounded-full group-hover:from-yellow-600 group-hover:via-yellow-700 group-hover:to-orange-600 transition-all duration-500 absolute top-0 right-0 shadow-lg group-hover:shadow-yellow-400/50 border-2 border-white/60 group-hover:scale-110 flex items-center justify-center z-30" style="animation-delay: 0.2s;">
                                            <span class="text-white text-xs font-bold">+1</span>
                                        </div>
                                    </div>
                                @elseif($pack->pack_size === 6)
                                    <!-- 6 cercles disposés en cascade/éventail comme sur l'image -->
                                    <div class="relative w-24 h-12 sm:w-32 sm:h-16">
                                        <!-- Cercle 1 (tout à l'arrière) -->
                                        <div class="w-6 h-6 sm:w-10 sm:h-10 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-2 sm:top-3 left-2 sm:left-3 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-5 h-5 sm:w-8 sm:h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[8px] sm:text-[10px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Cercle 2 -->
                                        <div class="w-6 h-6 sm:w-10 sm:h-10 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-1 sm:top-2 left-4 sm:left-6 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-5 h-5 sm:w-9 sm:h-9 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[8px] sm:text-[10px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Cercle 3 -->
                                        <div class="w-6 h-6 sm:w-10 sm:h-10 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-0 sm:top-1 left-6 sm:left-9 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-5 h-5 sm:w-9 sm:h-9 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[8px] sm:text-[10px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Cercle 4 -->
                                        <div class="w-6 h-6 sm:w-10 sm:h-10 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-0 sm:top-1 left-8 sm:left-12 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-5 h-5 sm:w-9 sm:h-9 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[8px] sm:text-[10px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Cercle 5 -->
                                        <div class="w-6 h-6 sm:w-10 sm:h-10 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-1 sm:top-2 left-10 sm:left-15 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-5 h-5 sm:w-9 sm:h-9 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[8px] sm:text-[10px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Cercle 6 (au premier plan) -->
                                        <div class="w-6 h-6 sm:w-10 sm:h-10 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-2 sm:top-3 left-12 sm:left-18 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-5 h-5 sm:w-9 sm:h-9 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[8px] sm:text-[10px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                    </div>
                                @elseif($pack->pack_size === 10)
                                    <!-- 10 cercles disposés en pyramide triangulaire comme sur l'image -->
                                    <div class="relative w-20 h-16 sm:w-28 sm:h-20">
                                        <!-- Rangée 1 (arrière): 4 cercles -->
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-0 left-1 sm:left-2 shadow-lg border-2 border-white/70 z-40">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-0 left-3 sm:left-6 shadow-lg border-2 border-white/70 z-40">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-0 left-5 sm:left-10 shadow-lg border-2 border-white/70 z-40">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-0 left-7 sm:left-14 shadow-lg border-2 border-white/70 z-40">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Rangée 2: 3 cercles -->
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-2 sm:top-4 left-2 sm:left-4 shadow-lg border-2 border-white/70 z-50">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-2 sm:top-4 left-4 sm:left-8 shadow-lg border-2 border-white/70 z-50">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-2 sm:top-4 left-6 sm:left-12 shadow-lg border-2 border-white/70 z-50">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Rangée 3: 2 cercles -->
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-4 sm:top-8 left-3 sm:left-6 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-4 sm:top-8 left-5 sm:left-10 shadow-lg border-2 border-white/70 z-60">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                        
                                        <!-- Rangée 4: 1 cercle (avant) -->
                                        <div class="w-4 h-4 sm:w-8 sm:h-8 bg-gradient-to-br from-white via-gray-100 to-gray-300 rounded-full absolute top-6 sm:top-12 left-4 sm:left-8 shadow-lg border-2 border-white/70 z-70">
                                            <div class="w-3 h-3 sm:w-7 sm:h-7 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-gray-200 to-gray-400 border border-white/30 flex items-center justify-center text-[6px] sm:text-[9px] font-bold text-gray-700"><img src="https://www.soundtags.fr/public/images/logo-no-text.png" alt="NFC Tag" class="w-full h-full object-contain rounded-full"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <h3 class="font-display font-bold text-lg sm:text-xl lg:text-2xl text-white mb-3 sm:mb-4">
                                {{ $pack->name }}
                            </h3>

                            <p class="text-gray-400 mb-4 sm:mb-6 leading-relaxed text-sm sm:text-base">
                                {{ $pack->short_description }}
                            </p>

                            <!-- Prix -->
                            <div class="mb-4 sm:mb-6">
                                <div class="flex items-center justify-center space-x-2 sm:space-x-3 mb-2">
                                    <span class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white">
                                        {{ number_format($pack->price, 2) }} €
                                    </span>
                                    @if($pack->original_price)
                                        <span class="text-base sm:text-xl text-gray-400 line-through">
                                            {{ number_format($pack->original_price, 2) }} €
                                        </span>
                                    @endif
                                </div>

                                @if($pack->original_price)
                                    @php
                                        $savings = round((($pack->original_price - $pack->price) / $pack->original_price) * 100);
                                    @endphp
                                    <div class="inline-flex items-center bg-green-600 text-white text-xs sm:text-sm font-medium px-2 sm:px-3 py-1 rounded-full">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('common.Économisez') }} {{ $savings }}%
                                    </div>
                                @endif
                            </div>

                            <!-- Prix par tag -->
                            <div class="text-xs sm:text-sm text-gray-400 mb-4 sm:mb-6">
                                {{ __('common.Soit') }} {{ number_format($pack->price / $pack->pack_size, 2) }} € {{ __('common.par sound tag') }}
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="px-4 sm:px-6 lg:px-8 pb-4 sm:pb-6 lg:pb-8">
                            <ul class="space-y-2 sm:space-y-3 mb-6 sm:mb-8">
                                <li class="flex items-center text-gray-300 text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('packs.Choix libre parmi tous nos tags') }}
                                </li>
                                <li class="flex items-center text-gray-300 text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('packs.Livraison gratuite') }}
                                </li>
                                <li class="flex items-center text-gray-300 text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('packs.Support technique inclus') }}
                                </li>
                            </ul>

                            <!-- CTA Button -->
                            <a href="{{ route('packs.show', $pack) }}"
                               class="block w-full text-center px-4 sm:px-6 lg:px-8 py-2.5 sm:py-3 lg:py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 group-hover:shadow-xl text-sm sm:text-base">
                                {{ __('packs.Personnaliser mon pack') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Comment ça marche -->
    <section class="py-12 sm:py-16 bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="font-display font-bold text-2xl sm:text-3xl text-white mb-4">
                    {{ __('common.Comment ça marche ?') }}
                </h2>
                <p class="text-gray-400 max-w-2xl mx-auto text-sm sm:text-base">
                    {{ __('packs.Créez votre pack personnalisé en 3 étapes simples') }}
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white text-black rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold mx-auto mb-4 sm:mb-6">
                        1
                    </div>
                    <h3 class="font-semibold text-lg sm:text-xl text-white mb-3 sm:mb-4">
                        {{ __('packs.Choisissez votre pack') }}
                    </h3>
                    <p class="text-gray-400 text-sm sm:text-base">
                        {{ __('packs.Sélectionnez le nombre de sound tags que vous souhaitez (3, 6 ou 10)') }}
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white text-black rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold mx-auto mb-4 sm:mb-6">
                        2
                    </div>
                    <h3 class="font-semibold text-lg sm:text-xl text-white mb-3 sm:mb-4">
                        {{ __('packs.Personnalisez') }}
                    </h3>
                    <p class="text-gray-400 text-sm sm:text-base">
                        {{ __('packs.Choisissez vos sound tags préférés parmi toute notre collection disponible') }}
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white text-black rounded-full flex items-center justify-center text-xl sm:text-2xl font-bold mx-auto mb-4 sm:mb-6">
                        3
                    </div>
                    <h3 class="font-semibold text-lg sm:text-xl text-white mb-3 sm:mb-4">
                        {{ __('packs.Recevez') }}
                    </h3>
                    <p class="text-gray-400 text-sm sm:text-base">
                        {{ __('packs.Votre pack personnalisé arrive chez vous avec tous les extras inclus') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-display font-bold text-2xl sm:text-3xl text-white text-center mb-8 sm:mb-12">
                    {{ __('common.Questions fréquentes') }}
                </h2>

                <div class="space-y-4 sm:space-y-6">
                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-4 sm:p-6">
                        <h3 class="font-semibold text-base sm:text-lg text-white mb-3">
                            {{ __('packs.Puis-je changer les sound tags après commande ?') }}
                        </h3>
                        <p class="text-gray-400 text-sm sm:text-base">
                            {{ __('packs.Une fois votre commande validée, les sound tags ne peuvent plus être modifiés car ils sont immédiatement préparés pour l\'expédition. Prenez bien le temps de faire votre sélection !') }}
                        </p>
                    </div>

                    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-4 sm:p-6">
                        <h3 class="font-semibold text-base sm:text-lg text-white mb-3">
                            {{ __('packs.Puis-je avoir plusieurs fois le même sound tag dans un pack ?') }}
                        </h3>
                        <p class="text-gray-400 text-sm sm:text-base">
                            {{ __('packs.Oui, vous pouvez choisir plusieurs fois le même sound tag si vous le souhaitez. Pratique pour offrir ou avoir des doublons de vos favoris !') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
