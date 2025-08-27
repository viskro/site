<x-app-layout>
    <x-slot name="title">{{ __('Livraison & Retours') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('Accueil'), 'url' => route('home')], ['label' => __('Livraison & Retours')]]" />
                <h1 class="font-display font-bold text-4xl text-white mb-2">{{ __('Livraison & Retours') }}</h1>
                <p class="text-gray-400 mb-8">{{ __('Informations sur l’expédition et la politique de retours/échanges.') }}</p>

                <div class="space-y-6">
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Livraison</h2>
                        <p class="text-gray-300 leading-relaxed">Les Sound Tags sont des produits physiques expédiés après confirmation du paiement. Délais indicatifs en France métropolitaine: 2 à 5 jours ouvrés.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Retours & Remboursements</h2>
                        <p class="text-gray-300 leading-relaxed">Les remboursements ne sont pas possibles. En cas de produit défectueux à la réception, contactez notre support sous 48h pour organiser un échange ou une solution adaptée.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Support</h2>
                        <p class="text-gray-300">Pour toute question: support@soundtags.fr</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


