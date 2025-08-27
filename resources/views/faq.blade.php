<x-app-layout>
    <x-slot name="title">{{ __('FAQ - Questions fréquentes') }}</x-slot>

    <section class="bg-gray-900 py-12 lg:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Nos réseaux en tête -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 mb-10">
                    <h2 class="font-display font-bold text-2xl text-white mb-4 text-center">{{ __('Nos réseaux') }}</h2>
                    <p class="text-gray-300 text-center mb-6">{{ __('Suivez nos actualités, nouveaux sons et coulisses.') }}</p>
                    <div class="flex items-center justify-center space-x-8">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center space-x-2" aria-label="TikTok">
                            <img src="{{ asset('storage/images/socials/tiktok.svg') }}" alt="TikTok" class="w-7 h-7"/>
                            <span>TikTok</span>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center space-x-2" aria-label="Instagram">
                            <img src="{{ asset('storage/images/socials/instagram.svg') }}" alt="Instagram" class="w-7 h-7"/>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center space-x-2" aria-label="X">
                            <img src="{{ asset('storage/images/socials/x.svg') }}" alt="X" class="w-7 h-7"/>
                            <span>X</span>
                        </a>
                    </div>
                </div>

                <h1 class="font-display font-bold text-4xl text-white mb-8 text-center">{{ __('FAQ') }}</h1>

                <!-- Accordéon de Q/R -->
                <div class="divide-y divide-gray-700 bg-gray-800 border border-gray-700 rounded-2xl">
                    <details class="group p-6" open>
                        <summary class="flex items-center justify-between cursor-pointer list-none">
                            <span class="text-white font-semibold text-lg">{{ __('Le produit est-il numérique ou physique ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300">{{ __('Nos Sound Tags sont des produits physiques NFC que vous recevez chez vous. Ils déclenchent un son lorsque vous approchez un smartphone compatible NFC.') }}</div>
                    </details>

                    <details class="group p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none">
                            <span class="text-white font-semibold text-lg">{{ __('Comment utiliser un Sound Tag ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300">{{ __('Il suffit d’approcher un smartphone compatible NFC du tag. Aucun téléchargement d’application n’est nécessaire.') }}</div>
                    </details>

                    <details class="group p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none">
                            <span class="text-white font-semibold text-lg">{{ __('Quels sont les délais de livraison ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300">{{ __('Nous expédions rapidement. La livraison en France métropolitaine prend généralement 2 à 5 jours ouvrés.') }}</div>
                    </details>

                    <details class="group p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none">
                            <span class="text-white font-semibold text-lg">{{ __('Proposez-vous des remboursements ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300">{{ __('Les remboursements ne sont pas possibles. Si votre produit présente un défaut à la réception, contactez-nous et nous trouverons une solution (échange, etc.).') }}</div>
                    </details>

                    <details class="group p-6">
                        <summary class="flex items-center justify-between cursor-pointer list-none">
                            <span class="text-white font-semibold text-lg">{{ __('Le smartphone doit-il être connecté à internet ?') }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </summary>
                        <div class="mt-3 text-gray-300">{{ __('Une connexion internet peut être requise pour lire certains contenus audio hébergés en ligne. La plupart des smartphones utilisent les données mobiles disponibles.') }}</div>
                    </details>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>


