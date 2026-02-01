<x-app-layout>
    <x-slot name="title">{{ __('common.Mentions légales') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('common.Accueil'), 'url' => route('home')], ['label' => __('common.Mentions légales')]]" />
                <h1 class="font-display font-bold text-4xl text-white mb-2">{{ __('common.Mentions légales') }}</h1>
                <p class="text-gray-400 mb-8">{{ __('legal.Informations obligatoires concernant l\'éditeur et l\'hébergement du site.') }}</p>

                <div class="space-y-6">
                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Éditeur du site') }}</h2>
                        <p class="text-gray-300 leading-relaxed">Raison sociale: Sound Tags<br>Forme juridique: SAS<br>Siège social: 10 rue Exemple, 75000 Paris, France<br>RCS: Paris 000 000 000<br>TVA intracommunautaire: FR00 000000000</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Contact') }}</h2>
                        <p class="text-gray-300 leading-relaxed">Email: support@soundtags.fr<br>Téléphone: +33 1 23 45 67 89</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Directeur de la publication') }}</h2>
                        <p class="text-gray-300 leading-relaxed">Nom du directeur de publication</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Hébergement') }}</h2>
                        <p class="text-gray-300 leading-relaxed">Nom de l’hébergeur<br>Adresse de l’hébergeur</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Propriété intellectuelle') }}</h2>
                        <p class="text-gray-300 leading-relaxed">L’ensemble des éléments du site (textes, graphismes, logos, contenus audio) est protégé par le droit d’auteur et la propriété intellectuelle. Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site est interdite sans autorisation écrite préalable.</p>
                    </section>

                    <section>
                        <h2 class="text-white text-2xl font-semibold mb-2">{{ __('legal.Responsabilité') }}</h2>
                        <p class="text-gray-300 leading-relaxed">Sound Tags s’efforce d’assurer l’exactitude des informations mais ne saurait être tenu responsable des erreurs ou omissions.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


