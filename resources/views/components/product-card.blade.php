@props(['product'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <!-- Product Image -->
        <div class="aspect-w-1 aspect-h-1 bg-slate-200 overflow-hidden">
            @if($product->primaryImage)
                <img src="{{ Storage::url($product->primaryImage->path) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 flex items-center justify-center bg-slate-100">
                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="p-4">
            <!-- Category Badge -->
            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mb-2
                {{ $product->category->type === 'plant' ? 'bg-teal-100 text-teal-700' : '' }}
                {{ $product->category->type === 'shrimp' ? 'bg-cyan-100 text-cyan-700' : '' }}
                {{ $product->category->type === 'crab' ? 'bg-sky-100 text-sky-700' : '' }}">
                {{ $product->category->name }}
            </span>

            <!-- Product Name -->
            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $product->name }}</h3>

            @if($product->latin_name)
                <p class="text-sm text-slate-500 italic mb-2">{{ $product->latin_name }}</p>
            @endif

            <!-- Price -->
            <div class="flex items-center justify-between mt-4">
                <span class="text-2xl font-bold text-sky-600">{{ number_format($product->price, 2, ',', '.') }} €</span>

                <!-- Stock Badge -->
                @if($product->stock > 0)
                    <span class="px-2 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-full">
                        Auf Lager
                    </span>
                @else
                    <span class="px-2 py-1 text-xs font-semibold bg-rose-100 text-rose-700 rounded-full">
                        Ausverkauft
                    </span>
                @endif
            </div>

            <!-- Special Shipping Info -->
            @if($product->requires_special_shipping)
                <div class="mt-3 flex items-center text-xs text-amber-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tierversand erforderlich
                </div>
            @endif
        </div>
    </a>
</div>
