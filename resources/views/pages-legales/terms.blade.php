<x-app-layout>
    <x-slot name="title">{{ __('legal.Conditions d\'utilisation') }}</x-slot>

    <div class="min-h-screen bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl border border-gray-700 p-8">
                <x-layout.breadcrumb :items="[['label' => __('common.Accueil'), 'url' => route('home')], ['label' => __('common.Conditions d\'utilisation')]]" />
                <h1 class="font-display font-bold text-3xl text-white mb-6">{{ __('legal.Conditions d\'utilisation') }}</h1>

                <div class="prose prose-invert max-w-none space-y-6">
                    <section>
                        <h2>{{ __('legal.Objet') }}</h2>
                        <p>{{ __('legal.Les présentes conditions définissent les règles d\'utilisation du site et des services Sound Tags.') }}</p>
                    </section>

                    <section>
                        <h2>{{ __('legal.Compte utilisateur') }}</h2>
                        <p>{{ __('legal.Vous êtes responsable du maintien de la confidentialité de vos identifiants et de l\'activité réalisée sur votre compte.') }}</p>
                    </section>

                    <section>
                        <h2>{{ __('legal.Utilisation des contenus') }}</h2>
                        <p>{{ __('legal.Les sound tags sont fournis pour un usage conforme aux licences indiquées. Toute utilisation non autorisée est interdite.') }}</p>
                    </section>

                    <section>
                        <h2>{{ __('legal.Disponibilité') }}</h2>
                        <p>{{ __('legal.Le site peut être interrompu pour maintenance. Sound Tags ne saurait être tenu responsable des interruptions.') }}</p>
                    </section>

                    <section>
                        <h2>{{ __('legal.Responsabilité') }}</h2>
                        <p>{{ __('legal.Le site est fourni "en l\'état". Sound Tags ne garantit pas l\'absence d\'erreurs mais met tout en œuvre pour assurer la qualité du service.') }}</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

