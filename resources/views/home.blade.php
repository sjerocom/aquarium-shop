@extends('layouts.shop')

@section('title', config('shop.name') . ' - Aquaristik Online Shop')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-sky-400 to-cyan-500 text-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">Willkommen bei {{ config('shop.name') }}</h1>
        <p class="text-xl mb-8">Ihr Spezialist für Aquarienpflanzen, Garnelen und Krebse</p>
    </div>
</div>

<!-- Categories Section -->
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Unsere Kategorien</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <!-- Plants -->
        @if(isset($categories['plant']))
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-br from-teal-400 to-teal-500 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Pflanzen</h3>
                    <p class="text-teal-50">{{ $categories['plant']->sum('products_count') }} Produkte</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-2">
                        @foreach($categories['plant'] as $category)
                            <li>
                                <a href="{{ route('categories.show', $category->slug) }}" class="text-sky-600 hover:text-sky-700 flex justify-between items-center">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-sm text-slate-500">({{ $category->products_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('categories.index', 'plant') }}" class="mt-4 inline-block text-teal-600 hover:text-teal-700 font-semibold">
                        Alle Pflanzen →
                    </a>
                </div>
            </div>
        @endif

        <!-- Shrimp -->
        @if(isset($categories['shrimp']))
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-br from-cyan-400 to-cyan-500 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Garnelen</h3>
                    <p class="text-cyan-50">{{ $categories['shrimp']->sum('products_count') }} Produkte</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-2">
                        @foreach($categories['shrimp'] as $category)
                            <li>
                                <a href="{{ route('categories.show', $category->slug) }}" class="text-sky-600 hover:text-sky-700 flex justify-between items-center">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-sm text-slate-500">({{ $category->products_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('categories.index', 'shrimp') }}" class="mt-4 inline-block text-cyan-600 hover:text-cyan-700 font-semibold">
                        Alle Garnelen →
                    </a>
                </div>
            </div>
        @endif

        <!-- Crabs -->
        @if(isset($categories['crab']))
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-br from-sky-400 to-sky-500 text-white p-6">
                    <h3 class="text-2xl font-bold mb-2">Krebse</h3>
                    <p class="text-sky-50">{{ $categories['crab']->sum('products_count') }} Produkte</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-2">
                        @foreach($categories['crab'] as $category)
                            <li>
                                <a href="{{ route('categories.show', $category->slug) }}" class="text-sky-600 hover:text-sky-700 flex justify-between items-center">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-sm text-slate-500">({{ $category->products_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('categories.index', 'crab') }}" class="mt-4 inline-block text-sky-600 hover:text-sky-700 font-semibold">
                        Alle Krebse →
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Featured Products -->
    @if($featuredProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Neueste Produkte</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    @endif

    <!-- Info Banner -->
    <div class="mt-16 bg-sky-50 rounded-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Versandinformationen</h3>
                <p class="text-slate-700">
                    Wir versenden Pflanzen und Tiere sicher verpackt. Tierversand erfolgt per Overnight-Express.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Kontakt</h3>
                <p class="text-slate-700">
                    Bei Fragen stehen wir Ihnen gerne zur Verfügung:<br>
                    {{ config('shop.phone') }}<br>
                    {{ config('shop.email') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
