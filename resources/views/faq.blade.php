<x-app-layout>
    <x-slot name="title">{{ __('faq.FAQ - Questions fréquentes') }}</x-slot>

    <!-- Hero compact avec dégradé cohérent -->
    <section class="bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 py-12 lg:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="font-display font-bold text-3xl sm:text-4xl lg:text-5xl text-white mb-4">{{ __('common.FAQ') }}</h1>
                <p class="text-gray-300 text-base sm:text-lg">{{ __('faq.Toutes les réponses à vos questions sur les Sound Tags et la boutique.') }}</p>
            </div>
        </div>
    </section>

    <section class="bg-gray-900 py-10 lg:py-14">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Nos réseaux en tête, stylisés en boutons -->
                <div class="bg-gray-800/80 backdrop-blur border border-gray-700 rounded-2xl p-5 sm:p-6 mb-8 sm:mb-10 shadow-xl">
                    <h2 class="font-display font-bold text-xl sm:text-2xl text-white mb-2 sm:mb-3 text-center">{{ __('faq.Nos réseaux') }}</h2>
                    <p class="text-gray-300 text-center mb-5 sm:mb-6 text-sm sm:text-base">{{ __('faq.Suivez nos actualités, nouveaux sons et coulisses.') }}</p>
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-2 rounded-full border border-gray-700 bg-gray-900 text-gray-200 hover:bg-white hover:text-black transition-all duration-200 shadow hover:shadow-lg" aria-label="TikTok">
                            <img src="https://www.soundtags.fr/public/images/socials/tiktok.svg" alt="TikTok" class="w-5 h-5 sm:w-6 sm:h-6"/>
                            <span class="text-sm sm:text-base">TikTok</span>
                        </a>
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-2 rounded-full border border-gray-700 bg-gray-900 text-gray-200 hover:bg-white hover:text-black transition-all duration-200 shadow hover:shadow-lg" aria-label="Instagram">
                            <img src="https://www.soundtags.fr/public/images/socials/instagram.svg" alt="Instagram" class="w-5 h-5 sm:w-6 sm:h-6"/>
                            <span class="text-sm sm:text-base">Instagram</span>
                        </a>
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-2 rounded-full border border-gray-700 bg-gray-900 text-gray-200 hover:bg-white hover:text-black transition-all duration-200 shadow hover:shadow-lg" aria-label="X">
                            <img src="https://www.soundtags.fr/public/images/socials/x.svg" alt="X" class="w-5 h-5 sm:w-6 sm:h-6"/>
                            <span class="text-sm sm:text-base">X</span>
                        </a>
                    </div>
                </div>

                <!-- Accordéon de Q/R avec hover, focus et transitions -->
                <div class="js-faq-accordion bg-gray-800/80 backdrop-blur border border-gray-700 rounded-2xl overflow-hidden shadow-xl divide-y divide-gray-700">
                    <details class="group p-4 sm:p-6" open>
                        <summary class="flex items-center justify-between cursor-pointer list-none focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500/40 rounded-xl transition-colors">
                            <span class="text-white font-semibold text-base sm:text-lg pr-4 group-hover:text-white">{{ __('faq.Le produit est-il numérique ou physique ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300 text-sm sm:text-base leading-relaxed">{{ __('faq.Nos Sound Tags sont des produits physiques NFC que vous recevez chez vous. Ils déclenchent un son lorsque vous approchez un smartphone compatible NFC.') }}</div>
                    </details>

                    <details class="group p-4 sm:p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500/40 rounded-xl transition-colors">
                            <span class="text-white font-semibold text-base sm:text-lg pr-4 group-hover:text-white">{{ __('faq.Comment utiliser un Sound Tag ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300 text-sm sm:text-base leading-relaxed">{{ __('faq.Il suffit d\'approcher un smartphone compatible NFC du tag. Aucun téléchargement d\'application n\'est nécessaire.') }}</div>
                    </details>

                    <details class="group p-4 sm:p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500/40 rounded-xl transition-colors">
                            <span class="text-white font-semibold text-base sm:text-lg pr-4 group-hover:text-white">{{ __('faq.Comment recevrai-je ma commande ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="text-gray-300 text-sm leading-relaxed">{{ __('faq.Nous expédions rapidement. Vous recevrez votre commande directement chez vous.') }}</div>
                    </details>

                    <details class="group p-4 sm:p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500/40 rounded-xl transition-colors">
                            <span class="text-white font-semibold text-base sm:text-lg pr-4 group-hover:text-white">{{ __('faq.Proposez-vous des remboursements ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300 text-sm sm:text-base leading-relaxed">{{ __('faq.Les remboursements ne sont pas possibles. Si votre produit présente un défaut à la réception, contactez-nous et nous trouverons une solution (échange, etc.).') }}</div>
                    </details>

                    <details class="group p-4 sm:p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500/40 rounded-xl transition-colors">
                            <span class="text-white font-semibold text-base sm:text-lg pr-4 group-hover:text-white">{{ __('faq.Le smartphone doit-il être connecté à internet ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300 text-sm sm:text-base leading-relaxed">{{ __('faq.Une connexion internet peut être requise pour lire certains contenus audio hébergés en ligne. La plupart des smartphones utilisent les données mobiles disponibles.') }}</div>
                    </details>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>


