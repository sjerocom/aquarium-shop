@extends('layouts.shop')

@section('title', 'Warenkorb - ' . config('shop.name'))

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Warenkorb</h1>

    @if(session('success'))
        <div class="mb-6 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-rose-100 border border-rose-400 text-rose-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if(count($items) > 0)
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Produkt</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Preis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Menge</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Gesamt</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aktion</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($items as $productId => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        @if($item['image'])
                                            <img class="h-16 w-16 rounded object-cover" src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}">
                                        @else
                                            <div class="h-16 w-16 bg-slate-200 rounded flex items-center justify-center">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <a href="{{ route('products.show', $item['slug']) }}" class="text-sm font-medium text-gray-900 hover:text-sky-600">
                                            {{ $item['name'] }}
                                        </a>
                                        @if($item['latin_name'])
                                            <p class="text-sm text-slate-500 italic">{{ $item['latin_name'] }}</p>
                                        @endif
                                        <p class="text-xs text-slate-500">{{ $item['category'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($item['price'], 2, ',', '.') }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.updateQuantity', $productId) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                           class="w-20 px-2 py-1 border border-slate-300 rounded-md text-sm focus:ring-sky-500 focus:border-sky-500">
                                    <button type="submit" class="text-sky-600 hover:text-sky-700 text-sm font-medium">
                                        Aktualisieren
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('cart.remove', $productId) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800">
                                        Entfernen
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Cart Summary -->
        <div class="bg-white shadow-md rounded-lg p-6 max-w-md ml-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Zusammenfassung</h2>

            <div class="space-y-2 mb-6">
                <div class="flex justify-between text-slate-700">
                    <span>Artikel ({{ count($items) }})</span>
                    <span>{{ number_format($total, 2, ',', '.') }} €</span>
                </div>
                <div class="border-t pt-2 flex justify-between text-lg font-bold text-gray-900">
                    <span>Gesamt</span>
                    <span>{{ number_format($total, 2, ',', '.') }} €</span>
                </div>
            </div>

            <div class="bg-sky-50 border border-sky-200 rounded-lg p-4 mb-4">
                <p class="text-sm text-sky-800">
                    <strong>Hinweis:</strong> Checkout-Funktion kommt in v2. Aktuell können Sie nur Produkte sammeln.
                </p>
            </div>

            <div class="space-y-2">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-rose-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-rose-600 transition-colors">
                        Warenkorb leeren
                    </button>
                </form>

                <a href="{{ route('home') }}" class="block text-center bg-slate-200 text-slate-700 py-3 px-6 rounded-lg font-semibold hover:bg-slate-300 transition-colors">
                    Weiter einkaufen
                </a>
            </div>
        </div>

    @else
        <!-- Empty Cart -->
        <div class="bg-white shadow-md rounded-lg p-12 text-center">
            <svg class="mx-auto h-24 w-24 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Ihr Warenkorb ist leer</h2>
            <p class="text-slate-600 mb-6">Fügen Sie Produkte hinzu um mit dem Einkaufen zu beginnen.</p>
            <a href="{{ route('home') }}" class="inline-block bg-sky-500 text-white py-3 px-8 rounded-lg font-semibold hover:bg-sky-600 transition-colors">
                Produkte entdecken
            </a>
        </div>
    @endif
</div>
@endsection
