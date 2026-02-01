<x-app-layout>
    <x-slot name="title">{{ $product->meta_title ?? $product->name . ' - Sound Tags' }}</x-slot>
    <x-slot name="metaDescription">{{ $product->meta_description ?? $product->short_description }}</x-slot>

    <!-- Breadcrumb -->
    <section class="bg-gray-800 border-b border-gray-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">
                            {{ __('common.Accueil') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-600 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white transition-colors">
                                {{ __('common.Produits') }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-600 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-300">{{ $product->name }}</span>
                        </div>

                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Details -->
    <section class="py-12 lg:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-16">

                <!-- Images / Media -->
                <div class="space-y-6">
                    <!-- Image principale -->
                    <div class="aspect-square bg-gray-800 rounded-2xl overflow-hidden border border-gray-700">
                        @if($product->image)
                            <img
                                src="https://www.soundtags.fr/public/images/products/{{ $product->image }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-32 h-32 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Player Audio -->
                    @if($product->audio_file)
                        <x-product.audio-player
                            audioUrl="https://www.soundtags.fr/public/audio/{{ $product->audio_file }}"
                            :duration="$product->audio_duration"
                            :productName=" $product->name "
                        />
                    @endif

                    <!-- Gallery -->
                    @if($product->gallery && is_array(json_decode($product->gallery, true)) && count(json_decode($product->gallery, true)) > 0)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach(json_decode($product->gallery, true) as $image)
                                <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden border border-gray-700 cursor-pointer hover:border-gray-600 transition-colors">
                                    <img
                                        src="{{ asset('storage/images/products/' . $image) }}"
                                        alt="Gallery image"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="space-y-8">

                    <!-- Header -->
                    <div>
                        <h1 class="font-display font-bold text-2xl sm:text-3xl lg:text-4xl text-white mb-4">
                            {{ $product->name }}
                        </h1>

                        <!-- Prix -->
                        <div class="flex flex-col sm:flex-row sm:items-baseline space-y-2 sm:space-y-0 sm:space-x-3 mb-4">
                            <span class="text-2xl sm:text-3xl font-bold text-white">
                                {{ number_format($product->price, 2) }} €
                            </span>
                            @if($product->original_price && $product->original_price > $product->price)
                                <span class="text-xl text-gray-400 line-through">
                                    {{ number_format($product->original_price, 2) }} €
                                </span>
                                <span class="bg-red-600 text-white px-2 py-1 rounded-full text-sm font-medium">
                                    -{{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%
                                </span>
                            @endif
                        </div>

                        <!-- Stock retiré (illimité) -->
                    </div>

                    <!-- Description -->
                    @if($product->short_description)
                        <div class="prose prose-invert max-w-none">
                            <p class="text-gray-300 text-lg leading-relaxed">
                                {{ $product->short_description }}
                            </p>
                        </div>
                    @endif

                    <!-- Add to Cart Form -->
                    <div class="space-y-4">
                        <x-product.add-to-cart-form :product="$product" />

                    </div>

                    <!-- Features -->
                    <div class="border-t border-gray-700 pt-8">
                        <h3 class="font-semibold text-white mb-4">{{ __('product.Caractéristiques') }}</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-300">{{ __('product.Compatible tous smartphones') }}</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-300">{{ __('product.Technologie NFC') }}</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-300">{{ __('product.Son haute qualité') }}</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-300">{{ __('product.Expédition rapide') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Produits similaires -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-display font-bold text-2xl text-white mb-8 text-center">
                    {{ __('product.Vous aimerez aussi') }}
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <x-ui.product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-app-layout>
