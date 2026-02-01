<x-app-layout>
    <x-slot name="title">{{ __('product.Tous nos Sound Tags - Produits') }}</x-slot>
    <x-slot name="metaDescription">{{ __('product.Découvrez tous nos tags NFC sonores. 10 variantes uniques pour surprendre vos amis.') }}</x-slot>

    <!-- Header de la page -->
    <section class="bg-gray-800 border-b border-gray-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="font-display font-bold text-4xl lg:text-5xl text-white mb-4">
                    {{ __('product.Nos Sound Tags') }}
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    {{ __('product.Découvrez tous nos tags NFC avec des sons uniques pour surprendre vos proches.') }}
                </p>
            </div>
        </div>
    </section>

    <!-- En-tête simple sans filtres/tri -->
    <section class="bg-gray-900 border-b border-gray-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-gray-300">
                <span class="font-medium">{{ $products->count() }}</span>
                {{ __('common.produits') }}
            </div>
        </div>
    </section>

    <!-- Grille de produits -->
    <section class="py-12 lg:py-16">
        <div>
            <h2 class="text-center text-xl font-bold text-gray-400 mb-10">
                {{ __('product.Les prévisualisations des Sound Tags sont fortes, baissez le volume.') }}
            </h2>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            @if($products->count() > 0)
                <!-- Grille -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8 mb-12">
                    @foreach($products as $product)
                            <x-ui.product-card :product="$product" />
                    @endforeach
                </div>

            @else
                <!-- État vide -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-xl text-white mb-2">
                        {{ __('product.Aucun produit trouvé') }}
                    </h3>
                    <p class="text-gray-400 mb-6">
                        {{ __('product.Essayez de modifier vos filtres ou revenez plus tard.') }}
                    </p>
                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition-colors"
                    >
                        {{ __('common.Voir tous les produits') }}
                    </a>
                </div>
            @endif
        </div>
    </section>

</x-app-layout>

<script>
    function productFilters() {
        return {
            showCategoryFilter: false,
            showPriceFilter: false,
            showSortFilter: false
        }
    }
</script>
