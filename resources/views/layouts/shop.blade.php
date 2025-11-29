<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('shop.name'))</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}"
                           class="flex items-center gap-3 group hover:scale-105 transition-transform duration-200">
                            <x-logo-shrimp class="h-11 w-11 group-hover:drop-shadow-lg transition-all duration-200" />
                            <span class="text-xl font-bold text-sky-500 group-hover:text-sky-600 transition-colors">
                                {{ config('shop.name') }}
                            </span>
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-sky-400 text-gray-900' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} text-sm font-medium">
                            Home
                        </a>
                        <a href="{{ route('categories.index', 'plant') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('kategorien/plant*') ? 'border-sky-400 text-gray-900' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} text-sm font-medium">
                            Pflanzen
                        </a>
                        <a href="{{ route('categories.index', 'shrimp') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('kategorien/shrimp*') ? 'border-sky-400 text-gray-900' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} text-sm font-medium">
                            Garnelen
                        </a>
                        <a href="{{ route('categories.index', 'crab') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('kategorien/crab*') ? 'border-sky-400 text-gray-900' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} text-sm font-medium">
                            Krebse
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('cart.index') }}" class="relative inline-flex items-center px-3 py-2 text-slate-500 hover:text-slate-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php
                            $cartService = app(\App\Services\CartService::class);
                            $cartCount = $cartService->getCount();
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-sky-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kontakt -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontakt</h3>
                    <p class="text-gray-300">{{ config('shop.address.street') }}</p>
                    <p class="text-gray-300">{{ config('shop.address.zip') }} {{ config('shop.address.city') }}</p>
                    <p class="text-gray-300 mt-2">{{ config('shop.phone') }}</p>
                    <p class="text-gray-300">{{ config('shop.email') }}</p>
                </div>

                <!-- Öffnungszeiten -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Öffnungszeiten</h3>
                    <p class="text-gray-300">{{ config('shop.opening_hours') }}</p>
                </div>

                <!-- Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Information</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('pages.shipping') }}" class="text-gray-300 hover:text-white">Versand</a></li>
                        <li><a href="{{ route('pages.privacy') }}" class="text-gray-300 hover:text-white">Datenschutz</a></li>
                        <li><a href="{{ route('pages.imprint') }}" class="text-gray-300 hover:text-white">Impressum</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-700 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('shop.name') }}. Alle Rechte vorbehalten.</p>
            </div>
        </div>
    </footer>
</body>
</html>
