@extends('layouts.shop')

@section('title', $product->name . ' - ' . config('shop.name'))

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-slate-700 hover:text-sky-600">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('categories.show', $product->category->slug) }}" class="ml-1 text-slate-700 hover:text-sky-600">
                        {{ $product->category->name }}
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-slate-500">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <!-- Images -->
        <div>
            @if($product->images->count() > 0)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                    <img id="mainImage"
                         src="{{ Storage::url($product->images->where('is_primary', true)->first()?->path ?? $product->images->first()->path) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-96 object-cover">
                </div>

                @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->images as $index => $image)
                            <img src="{{ Storage::url($image->path) }}"
                                 alt="{{ $product->name }}"
                                 onclick="changeImage('{{ Storage::url($image->path) }}', this)"
                                 class="thumbnail w-full h-24 object-cover rounded cursor-pointer hover:opacity-75 transition {{ $image->is_primary ? 'ring-2 ring-sky-500' : '' }}">
                        @endforeach
                    </div>
                @endif
            @else
                <div class="bg-slate-200 rounded-lg h-96 flex items-center justify-center">
                    <svg class="w-32 h-32 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div>
            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full mb-4
                {{ $product->category->type === 'plant' ? 'bg-teal-100 text-teal-700' : '' }}
                {{ $product->category->type === 'shrimp' ? 'bg-cyan-100 text-cyan-700' : '' }}
                {{ $product->category->type === 'crab' ? 'bg-sky-100 text-sky-700' : '' }}">
                {{ $product->category->name }}
            </span>

            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

            @if($product->latin_name)
                <p class="text-xl text-slate-500 italic mb-6">{{ $product->latin_name }}</p>
            @endif

            <div class="mb-6">
                <span class="text-4xl font-bold text-sky-600">{{ number_format($product->price, 2, ',', '.') }} €</span>
            </div>

            <!-- Stock Status -->
            <div class="mb-6">
                @if($product->stock > 0)
                    <span class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Auf Lager ({{ $product->stock }} Stück)
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-2 bg-rose-100 text-rose-700 rounded-full font-semibold">
                        Ausverkauft
                    </span>
                @endif
            </div>

            <!-- Special Shipping -->
            @if($product->requires_special_shipping)
                <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-amber-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-amber-900 mb-1">Tierversand erforderlich</h3>
                            <p class="text-sm text-amber-700">Lebende Tiere werden per Overnight-Express versendet.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Add to Cart -->
            <div class="mb-8">
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->slug) }}" method="POST">
                        @csrf
                        <div class="flex items-center space-x-4 mb-4">
                            <label for="quantity" class="text-sm font-medium text-slate-700">Menge:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                   class="w-24 px-3 py-2 border border-slate-300 rounded-lg focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <button type="submit" class="w-full bg-sky-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-sky-600 transition-colors">
                            In den Warenkorb
                        </button>
                    </form>
                    <p class="mt-2 text-sm text-slate-500 text-center">
                        Hinweis: Checkout kommt in v2. Sie können Produkte sammeln.
                    </p>
                @else
                    <button disabled class="w-full bg-slate-200 text-slate-500 py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                        Ausverkauft
                    </button>
                @endif
            </div>

            <!-- Description -->
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Beschreibung</h2>
                <p class="text-slate-700 whitespace-pre-line">{{ $product->description }}</p>
            </div>
        </div>
    </div>

    <!-- Attributes -->
    @if($product->attributes->count() > 0)
        <div class="mb-16">
            <x-attribute-table :productAttributes="$product->attributes" />
        </div>
    @endif

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Ähnliche Produkte</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <x-product-card :product="$relatedProduct" />
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
function changeImage(imageSrc, thumbnailElement) {
    // Update main image
    document.getElementById('mainImage').src = imageSrc;

    // Remove ring from all thumbnails
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('ring-2', 'ring-sky-500');
    });

    // Add ring to clicked thumbnail
    thumbnailElement.classList.add('ring-2', 'ring-sky-500');
}
</script>
@endsection
