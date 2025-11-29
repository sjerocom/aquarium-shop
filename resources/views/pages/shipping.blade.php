@extends('layouts.shop')

@section('title', 'Versandinformationen - ' . config('shop.name'))

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Versandinformationen</h1>

    <div class="prose max-w-none">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Versandkosten</h2>
        <p class="mb-4">
            Wir versenden unsere Produkte deutschlandweit. Die Versandkosten richten sich nach Art und Größe
            der bestellten Produkte.
        </p>

        <div class="bg-sky-50 border border-sky-200 rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-3">Standardversand (Pflanzen und Zubehör)</h3>
            <ul class="list-disc pl-6 mb-0">
                <li>Versandkosten: 5,99 €</li>
                <li>Kostenloser Versand ab 50 € Bestellwert</li>
                <li>Lieferzeit: 2-3 Werktage</li>
                <li>Versand mit DHL</li>
            </ul>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-3">Tierversand (Garnelen und Krebse)</h3>
            <ul class="list-disc pl-6 mb-0">
                <li>Versandkosten: 16,99 € (Overnight-Express)</li>
                <li>Lieferzeit: 24 Stunden (Overnight)</li>
                <li>Versand nur Montag-Mittwoch (kein Wochenendversand)</li>
                <li>Versand mit GO! Express</li>
                <li>Verpackung mit Styroporbox und Heatpack (im Winter)</li>
            </ul>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">Liefergebiet</h2>
        <p class="mb-4">
            Wir liefern derzeit ausschließlich innerhalb Deutschlands.
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">Verpackung</h2>
        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Pflanzen</h3>
        <p class="mb-4">
            Aquarienpflanzen werden in feuchtem Papier verpackt und in stabilen Kartons verschickt.
            So kommen die Pflanzen sicher und frisch bei Ihnen an.
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Lebende Tiere (Garnelen & Krebse)</h3>
        <p class="mb-4">
            Für den Tierversand verwenden wir spezielle Styroporboxen, die die Temperatur konstant halten.
            Die Tiere werden in Fischbeuteln mit ausreichend Wasser und Sauerstoff verpackt.
        </p>
        <ul class="list-disc pl-6 mb-4">
            <li>Professionelle Verpackung in Fischbeuteln</li>
            <li>Isolierte Styroporbox</li>
            <li>Bei Bedarf Heatpack oder Coolpack</li>
            <li>Polstermaterial zum Schutz</li>
        </ul>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">Versandbedingungen für Lebendtiere</h2>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
            <p class="mb-3">
                <strong>Wichtig:</strong> Bitte beachten Sie folgende Hinweise beim Tierversand:
            </p>
            <ul class="list-disc pl-6 mb-0">
                <li>Versand nur bei geeigneten Temperaturen (5-30°C)</li>
                <li>Kein Versand an Feiertagen</li>
                <li>Kein Versand vor Wochenenden</li>
                <li>Packstation-Lieferung nur nach Absprache</li>
                <li>Bitte stellen Sie sicher, dass jemand das Paket entgegennehmen kann</li>
            </ul>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">DOA-Garantie (Dead on Arrival)</h2>
        <p class="mb-4">
            Sollten Tiere tot oder in schlechtem Zustand bei Ihnen ankommen, kontaktieren Sie uns bitte
            innerhalb von 2 Stunden nach Zustellung mit Fotos. Wir bieten Ersatz oder Erstattung an.
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">Abholung</h2>
        <p class="mb-4">
            Sie können Ihre Bestellung auch gerne persönlich bei uns abholen. Vereinbaren Sie dazu
            bitte einen Termin per E-Mail oder Telefon.
        </p>
        <p class="mb-4">
            <strong>Öffnungszeiten:</strong><br>
            {{ config('shop.opening_hours') }}
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">Kontakt</h2>
        <p class="mb-4">
            Bei Fragen zum Versand erreichen Sie uns:<br>
            Telefon: {{ config('shop.phone') }}<br>
            E-Mail: {{ config('shop.email') }}
        </p>
    </div>
</div>
@endsection
