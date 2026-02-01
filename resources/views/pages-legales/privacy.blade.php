<x-app-layout>
    <x-slot name="title">{{ __('legal.Politique de confidentialité') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('common.Accueil'), 'url' => route('home')], ['label' => __('common.Confidentialité')]]" />
                <h1 class="font-display font-bold text-4xl text-white mb-2">{{ __('legal.Politique de confidentialité') }}</h1>
                <p class="text-gray-400 mb-8">{{ __('legal.Comment nous traitons vos données personnelles.') }}</p>

                <div class="space-y-6">
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Données collectées') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Nous collectons les données nécessaires au traitement des commandes: identité, coordonnées, informations de paiement (traitées par Stripe), données de commande.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Finalités et base légale') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Exécution du contrat (commande), respect d\'obligations légales (comptabilité), intérêt légitime (lutte contre la fraude, amélioration du service) et consentement (cookies non essentiels).') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Destinataires') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Prestataires impliqués dans l\'exécution du service (ex: paiement Stripe). Les données ne sont pas revendues.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Durée de conservation') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les données sont conservées pendant la durée nécessaire au traitement et aux obligations légales (ex: 10 ans pour les pièces comptables).') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Vos droits') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Droit d'accès, de rectification, d'effacement, de limitation, d'opposition et portabilité (dans les conditions du RGPD). Contact: dpo@soundtags.fr') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Transferts hors UE') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Le cas échéant, des garanties appropriées sont mises en place (clauses contractuelles types).') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Sécurité') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Mesures techniques et organisationnelles adaptées; les données de paiement sont traitées par Stripe.') }}</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

