@extends('layouts.shop')

@section('title', $typeName . ' - ' . config('shop.name'))

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $typeName }}</h1>
        <p class="text-slate-600">Wählen Sie eine Kategorie aus</p>
    </div>

    <!-- Categories Grid -->
    @if($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        @if($category->image)
                            <div class="h-48 bg-slate-200 overflow-hidden">
                                <img src="{{ Storage::url($category->image) }}"
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br
                                {{ $type === 'plant' ? 'from-teal-400 to-teal-500' : '' }}
                                {{ $type === 'shrimp' ? 'from-cyan-400 to-cyan-500' : '' }}
                                {{ $type === 'crab' ? 'from-sky-400 to-sky-500' : '' }}
                                flex items-center justify-center">
                                <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-sky-600 transition-colors">
                                {{ $category->name }}
                            </h2>

                            @if($category->description)
                                <p class="text-slate-600 mb-4">{{ Str::limit($category->description, 100) }}</p>
                            @endif

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-500">{{ $category->products_count }} Produkte</span>
                                <span class="text-sky-600 font-semibold group-hover:translate-x-1 transition-transform">
                                    Ansehen →
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-slate-600 text-lg">Keine Kategorien gefunden.</p>
        </div>
    @endif
</div>
@endsection
