<x-app-layout>
    <x-slot name="title">{{ __('Politique de cookies') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('Accueil'), 'url' => route('home')], ['label' => __('Cookies')]]" />
                <h1 class="font-display font-bold text-4xl text-white mb-2">{{ __('Politique de cookies') }}</h1>
                <p class="text-gray-400 mb-8">{{ __('Informations sur l’utilisation des cookies et vos choix.') }}</p>

                <div class="space-y-6">
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('Qu’est-ce qu’un cookie ?') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('Un cookie est un petit fichier déposé sur votre terminal pour améliorer l’expérience utilisateur (panier, session) et mesurer l’audience.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('Cookies utilisés sur ce site') }}</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left">
                                <thead class="text-gray-400 border-b border-gray-700">
                                    <tr>
                                        <th class="py-2 pr-4">{{ __('Nom') }}</th>
                                        <th class="py-2 pr-4">{{ __('Fournisseur') }}</th>
                                        <th class="py-2 pr-4">{{ __('Finalité') }}</th>
                                        <th class="py-2 pr-4">{{ __('Durée') }}</th>
                                        <th class="py-2 pr-4">{{ __('Catégorie') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-300 divide-y divide-gray-800">
                                    <tr>
                                        <td class="py-3 pr-4">sound_tags_session</td>
                                        <td class="py-3 pr-4">{{ config('app.name', 'Sound Tags') }}</td>
                                        <td class="py-3 pr-4">{{ __('Maintenir votre session et le panier.') }}</td>
                                        <td class="py-3 pr-4">{{ __('Session (env. 6h)') }}</td>
                                        <td class="py-3 pr-4">{{ __('Strictement nécessaire') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 pr-4">XSRF-TOKEN</td>
                                        <td class="py-3 pr-4">{{ config('app.name', 'Sound Tags') }}</td>
                                        <td class="py-3 pr-4">{{ __('Sécuriser les formulaires (protection CSRF).') }}</td>
                                        <td class="py-3 pr-4">{{ __('Quelques heures') }}</td>
                                        <td class="py-3 pr-4">{{ __('Strictement nécessaire') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 pr-4">_stripe_mid</td>
                                        <td class="py-3 pr-4">Stripe</td>
                                        <td class="py-3 pr-4">{{ __('Identifier l’équipement pour sécuriser le paiement et prévenir la fraude.') }}</td>
                                        <td class="py-3 pr-4">{{ __('Jusqu’à 1 an') }}</td>
                                        <td class="py-3 pr-4">{{ __('Paiement (tiers)') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="text-gray-400 mt-3">{{ __('Certains attributs techniques (SameSite, HttpOnly, Secure) peuvent varier selon votre navigateur et l’environnement (développement/production).') }}</p>
                    </section>
{{-- 
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('Gestion des cookies') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('Vous pouvez à tout moment paramétrer vos préférences et retirer votre consentement depuis le bandeau cookies.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('Durée de conservation') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('La durée de vie des cookies varie selon leur finalité (par exemple 13 mois maximum pour les cookies de mesure d’audience).') }}</p>
                    </section> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


