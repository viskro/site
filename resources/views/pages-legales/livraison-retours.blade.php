<x-app-layout>
    <x-slot name="title">{{ __('common.Livraison & Retours') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('common.Accueil'), 'url' => route('home')], ['label' => __('common.Livraison & Retours')]]" />
                <h1 class="font-display font-bold text-4xl text-white mb-2">{{ __('common.Livraison & Retours') }}</h1>
                <p class="text-gray-400 mb-8">{{ __('legal.Informations sur l\'expédition et la politique de retours/échanges.') }}</p>

                <div class="space-y-6">
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Livraison') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les Sound Tags sont des produits physiques expédiés après confirmation du paiement.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Retours & Remboursements') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les remboursements ne sont pas possibles. En cas de produit défectueux à la réception, contactez notre support sous 48h pour organiser un échange ou une solution adaptée.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Support') }}</h2>
                        <p class="text-gray-300">{{ __('legal.Pour toute question: support@soundtags.fr') }}</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


