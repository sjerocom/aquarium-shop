@extends('layouts.shop')

@section('title', 'Datenschutzerklärung - ' . config('shop.name'))

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Datenschutzerklärung</h1>

    <div class="prose max-w-none">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Datenschutz auf einen Blick</h2>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Allgemeine Hinweise</h3>
        <p class="mb-4">
            Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen Daten
            passiert, wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit denen Sie
            persönlich identifiziert werden können.
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Datenerfassung auf dieser Website</h3>
        <p class="mb-4">
            <strong>Wer ist verantwortlich für die Datenerfassung auf dieser Website?</strong><br>
            Die Datenverarbeitung auf dieser Website erfolgt durch den Websitebetreiber. Dessen Kontaktdaten
            können Sie dem Impressum dieser Website entnehmen.
        </p>

        <p class="mb-4">
            <strong>Wie erfassen wir Ihre Daten?</strong><br>
            Ihre Daten werden zum einen dadurch erhoben, dass Sie uns diese mitteilen. Hierbei kann es sich z.B. um
            Daten handeln, die Sie in ein Kontaktformular eingeben.
        </p>

        <p class="mb-4">
            Andere Daten werden automatisch oder nach Ihrer Einwilligung beim Besuch der Website durch unsere IT-Systeme
            erfasst. Das sind vor allem technische Daten (z.B. Internetbrowser, Betriebssystem oder Uhrzeit des Seitenaufrufs).
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">2. Hosting</h2>
        <p class="mb-4">
            Wir hosten die Inhalte unserer Website bei folgendem Anbieter:
        </p>
        <p class="mb-4">
            <strong>Externes Hosting</strong><br>
            Diese Website wird extern gehostet. Die personenbezogenen Daten, die auf dieser Website erfasst werden,
            werden auf den Servern des Hosters / der Hoster gespeichert.
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">3. Allgemeine Hinweise und Pflichtinformationen</h2>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Datenschutz</h3>
        <p class="mb-4">
            Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre
            personenbezogenen Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften sowie
            dieser Datenschutzerklärung.
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Hinweis zur verantwortlichen Stelle</h3>
        <p class="mb-4">
            Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:
        </p>
        <p class="mb-4">
            {{ config('shop.name') }}<br>
            {{ config('shop.owner') }}<br>
            {{ config('shop.address.street') }}<br>
            {{ config('shop.address.zip') }} {{ config('shop.address.city') }}
        </p>
        <p class="mb-4">
            Telefon: {{ config('shop.phone') }}<br>
            E-Mail: {{ config('shop.email') }}
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Speicherdauer</h3>
        <p class="mb-4">
            Soweit innerhalb dieser Datenschutzerklärung keine speziellere Speicherdauer genannt wurde, verbleiben
            Ihre personenbezogenen Daten bei uns, bis der Zweck für die Datenverarbeitung entfällt.
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Ihre Rechte</h3>
        <p class="mb-4">
            Sie haben jederzeit das Recht:
        </p>
        <ul class="list-disc pl-6 mb-4">
            <li>Auskunft über Ihre bei uns gespeicherten personenbezogenen Daten zu erhalten</li>
            <li>Berichtigung unrichtiger personenbezogener Daten zu verlangen</li>
            <li>Löschung Ihrer bei uns gespeicherten personenbezogenen Daten zu verlangen</li>
            <li>Einschränkung der Datenverarbeitung zu verlangen</li>
            <li>Widerspruch gegen die Verarbeitung Ihrer Daten einzulegen</li>
            <li>Datenübertragbarkeit zu verlangen</li>
        </ul>

        <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">4. Datenerfassung auf dieser Website</h2>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Cookies</h3>
        <p class="mb-4">
            Unsere Internetseiten verwenden so genannte „Cookies". Cookies sind kleine Datenpakete und richten auf Ihrem
            Endgerät keinen Schaden an. Sie werden entweder vorübergehend für die Dauer einer Sitzung (Session-Cookies)
            oder dauerhaft (permanente Cookies) auf Ihrem Endgerät gespeichert.
        </p>

        <h3 class="text-xl font-bold text-gray-900 mb-3 mt-6">Server-Log-Dateien</h3>
        <p class="mb-4">
            Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten Server-Log-Dateien,
            die Ihr Browser automatisch an uns übermittelt. Dies sind:
        </p>
        <ul class="list-disc pl-6 mb-4">
            <li>Browsertyp und Browserversion</li>
            <li>verwendetes Betriebssystem</li>
            <li>Referrer URL</li>
            <li>Hostname des zugreifenden Rechners</li>
            <li>Uhrzeit der Serveranfrage</li>
            <li>IP-Adresse</li>
        </ul>
    </div>
</div>
@endsection
