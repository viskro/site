<x-app-layout>
    <x-slot name="title">{{ __('Conditions Générales de Vente') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('Accueil'), 'url' => route('home')], ['label' => __('CGV')]]" />
                <h1 class="font-display font-bold text-4xl text-white mb-2">{{ __('Conditions Générales de Vente') }}</h1>
                <p class="text-gray-400 mb-8">{{ __('Règles applicables aux ventes des produits Sound Tags.') }}</p>

                <div class="space-y-6">
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Objet</h2>
                        <p class="text-gray-300 leading-relaxed">Les présentes conditions régissent les ventes de produits physiques « Sound Tags » proposées par Sound Tags aux consommateurs en France.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Produits</h2>
                        <p class="text-gray-300 leading-relaxed">Les caractéristiques essentielles des produits sont présentées sur les fiches produits. Les images sont non contractuelles.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Prix</h2>
                        <p class="text-gray-300 leading-relaxed">Les prix sont indiqués en euros, toutes taxes comprises (TTC). Sound Tags se réserve le droit de modifier les prix à tout moment, le produit étant facturé sur la base du tarif en vigueur au moment de la validation de la commande.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Commande</h2>
                        <p class="text-gray-300 leading-relaxed">La commande est définitive après confirmation du paiement. Sound Tags se réserve le droit d’annuler une commande en cas de suspicion de fraude.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Paiement</h2>
                        <p class="text-gray-300 leading-relaxed">Le paiement est sécurisé via Stripe. Les données bancaires ne transitent pas par nos serveurs.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Livraison</h2>
                        <p class="text-gray-300 leading-relaxed">Les produits sont des articles physiques expédiés après confirmation du paiement. Les délais indicatifs pour la France métropolitaine sont de 2 à 5 jours ouvrés.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Retours / Remboursements</h2>
                        <p class="text-gray-300 leading-relaxed">Aucun remboursement n’est possible. En cas de produit défectueux à la réception ou endommagé pendant le transport, merci de nous contacter sous 48h avec photos à l’appui afin d’organiser un échange ou une solution adaptée.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Garanties</h2>
                        <p class="text-gray-300 leading-relaxed">Les produits bénéficient des garanties légales prévues par le Code de la consommation et le Code civil, dans la mesure applicable.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Service client</h2>
                        <p class="text-gray-300">support@soundtags.fr</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">Droit applicable / Litiges</h2>
                        <p class="text-gray-300 leading-relaxed">Le présent contrat est soumis au droit français. En cas de litige, une solution amiable sera recherchée avant toute action judiciaire. Le consommateur peut recourir à la médiation (art. L612-1 C. conso.).</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


