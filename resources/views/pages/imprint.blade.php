@extends('layouts.shop')

@section('title', 'Impressum - ' . config('shop.name'))

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Impressum</h1>

    <div class="prose max-w-none">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Angaben gemäß § 5 TMG</h2>

        <p class="mb-4">
            <strong>{{ config('shop.name') }}</strong><br>
            {{ config('shop.owner') }}<br>
            {{ config('shop.address.street') }}<br>
            {{ config('shop.address.zip') }} {{ config('shop.address.city') }}
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Kontakt</h3>
        <p class="mb-4">
            Telefon: {{ config('shop.phone') }}<br>
            E-Mail: {{ config('shop.email') }}
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Umsatzsteuer-ID</h3>
        <p class="mb-4">
            Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:<br>
            DE123456789
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h3>
        <p class="mb-4">
            {{ config('shop.owner') }}<br>
            {{ config('shop.address.street') }}<br>
            {{ config('shop.address.zip') }} {{ config('shop.address.city') }}
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Streitschlichtung</h3>
        <p class="mb-4">
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
            <a href="https://ec.europa.eu/consumers/odr/" target="_blank" class="text-sky-600 hover:underline">https://ec.europa.eu/consumers/odr/</a><br>
            Unsere E-Mail-Adresse finden Sie oben im Impressum.
        </p>

        <p class="mb-4">
            Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
            Verbraucherschlichtungsstelle teilzunehmen.
        </p>
    </div>
</div>
@endsection
