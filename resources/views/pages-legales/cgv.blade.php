<x-app-layout>
    <x-slot name="title">{{ __('legal.Conditions Générales de Vente') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('common.Accueil'), 'url' => route('home')], ['label' => __('common.CGV')]]" />
                <h1 class="font-display font-bold text-4xl text-white mb-2">{{ __('legal.Conditions Générales de Vente') }}</h1>
                <p class="text-gray-400 mb-8">{{ __('legal.Règles applicables aux ventes des produits Sound Tags.') }}</p>

                <div class="space-y-6">
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Objet') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les présentes conditions régissent les ventes de produits physiques « Sound Tags » proposées par Sound Tags aux consommateurs en France.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Produits') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les caractéristiques essentielles des produits sont présentées sur les fiches produits. Les images sont non contractuelles.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Prix') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les prix sont indiqués en euros, toutes taxes comprises (TTC). Sound Tags se réserve le droit de modifier les prix à tout moment, le produit étant facturé sur la base du tarif en vigueur au moment de la validation de la commande.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Commande') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.La commande est définitive après confirmation du paiement. Sound Tags se réserve le droit d\'annuler une commande en cas de suspicion de fraude.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Paiement') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Le paiement est sécurisé via Stripe. Les données bancaires ne transitent pas par nos serveurs.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Livraison') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les produits sont des articles physiques expédiés après confirmation du paiement.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Retours / Remboursements') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Aucun remboursement n\'est possible. En cas de produit défectueux à la réception ou endommagé pendant le transport, merci de nous contacter sous 48h avec photos à l\'appui afin d\'organiser un échange ou une solution adaptée.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Garanties') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Les produits bénéficient des garanties légales prévues par le Code de la consommation et le Code civil, dans la mesure applicable.') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Service client') }}</h2>
                        <p class="text-gray-300">{{ __('legal.support@soundtags.fr') }}</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Droit applicable / Litiges') }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ __('legal.Le présent contrat est soumis au droit français. En cas de litige, une solution amiable sera recherchée avant toute action judiciaire. Le consommateur peut recourir à la médiation (art. L612-1 C. conso.).') }}</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


