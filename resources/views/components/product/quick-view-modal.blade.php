<div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/60">
    <div class="bg-gray-800 border border-gray-700 rounded-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
        <div class="p-4 sm:p-6">
            <div class="flex items-start space-x-3 sm:space-x-4">
                <div class="w-16 h-16 sm:w-24 sm:h-24 bg-gray-700 rounded-lg overflow-hidden flex-shrink-0">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-white font-bold text-base sm:text-lg truncate">{{ $product->name }}</h3>
                    @if($product->is_on_sale)
                        <div class="mt-1 text-xs sm:text-sm">
                            <span class="text-white font-semibold">{{ number_format($product->price, 2) }} €</span>
                            <span class="text-gray-400 line-through ml-2">{{ number_format($product->original_price, 2) }} €</span>
                            <span class="text-green-400 ml-2">-{{ $product->discount_percentage }}%</span>
                        </div>
                    @else
                        <div class="mt-1 text-xs sm:text-sm text-white font-semibold">{{ number_format($product->price, 2) }} €</div>
                    @endif
                    <p class="text-gray-300 text-xs sm:text-sm mt-2 line-clamp-3">{{ $product->short_description ?? Str::limit($product->description, 160) }}</p>
                </div>
            </div>
            <div class="mt-4 sm:mt-6">
                <a href="{{ route('products.show', $product) }}" class="inline-flex items-center justify-center px-4 py-2 sm:px-4 sm:py-2.5 rounded-full bg-white text-gray-900 font-semibold hover:bg-gray-100 transition text-sm sm:text-base">
                    {{ __('common.Voir le produit') }}
                </a>
            </div>
        </div>
    </div>
</div>


