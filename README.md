# Aquarium Shop

Eine E-Commerce-Plattform für Aquaristik-Zubehör (Pflanzen, Garnelen, Krebse), entwickelt mit Laravel 11.

## Features

### Version 1 (Aktuell)
- Produktverwaltung über Filament Admin-Panel
- Kategoriebasierte Produktpräsentation (Pflanzen, Garnelen, Krebse)
- Detaillierte Produktattribute je nach Typ
- Multi-Bild-Support für Produkte
- Responsive Frontend mit Tailwind CSS
- Statische Seiten (Impressum, Kontakt)

### Version 2 (Geplant)
- Warenkorb-Funktionalität
- Kundenkonto & Authentifizierung
- Bestellprozess & Checkout
- Produktbewertungen
- Wunschliste
- Zahlungsintegration

## Tech Stack

- **Framework**: Laravel 11
- **Frontend**: Blade Templates + Livewire
- **CSS**: Tailwind CSS
- **Admin Panel**: Filament 3
- **Development**: Laravel Sail (Docker)
- **Datenbank**: MySQL
- **PHP**: 8.2+

## Installation

### Voraussetzungen
- Docker Desktop
- Git

### Setup

1. Repository klonen:
```bash
git clone https://github.com/sjerocom/aquarium-shop.git
cd aquarium-shop
```

2. Umgebungsvariablen kopieren:
```bash
cp .env.example .env
```

3. Sail Container starten:
```bash
./vendor/bin/sail up -d
```

4. Dependencies installieren:
```bash
./vendor/bin/sail composer install
```

5. Application Key generieren:
```bash
./vendor/bin/sail artisan key:generate
```

6. Datenbank migrieren:
```bash
./vendor/bin/sail artisan migrate
```

7. Admin-User erstellen:
```bash
./vendor/bin/sail artisan make:filament-user
```

Standard-Zugangsdaten: `admin@aquarium-shop.local` / `Admin123!`

## Entwicklung

### Container starten/stoppen
```bash
# Starten
./vendor/bin/sail up -d

# Stoppen
./vendor/bin/sail down
```

### Datenbank-Zugriff
- **Host**: localhost
- **Port**: 3306
- **User**: sail
- **Password**: password
- **Database**: laravel

### Wichtige URLs
- Frontend: http://localhost
- Admin-Panel: http://localhost/admin

### Nützliche Befehle

```bash
# Migration erstellen
./vendor/bin/sail artisan make:migration create_table_name

# Model erstellen
./vendor/bin/sail artisan make:model ModelName

# Filament Resource erstellen
./vendor/bin/sail artisan make:filament-resource ResourceName --generate

# Cache leeren
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan view:clear

# Package installieren
./vendor/bin/sail composer require package/name
```

## Projekt-Struktur

### Datenmodell

- **Category** → **Product** (one-to-many)
  - Kategorien: plant, shrimp, crab
  - URL-freundliche Slugs

- **Product** → **ProductAttribute** (one-to-many)
  - Typ-spezifische Attribute als Key-Value-Paare
  - Pflanzen: Lichtbedarf, Wuchshöhe, CO2-Bedarf, etc.
  - Garnelen/Krebse: Temperatur, pH-Wert, Größe, Sozialverhalten, etc.

- **Product** → **ProductImage** (one-to-many)
  - Mehrere Bilder pro Produkt
  - Primary-Flag und Sortierung

### Routes

- `/` - Startseite
- `/pflanzen` - Pflanzen-Kategorie
- `/garnelen` - Garnelen-Kategorie
- `/krebse` - Krebse-Kategorie
- `/produkt/{slug}` - Produktdetails
- `/admin` - Admin-Panel (Filament)
- `/impressum` - Impressum
- `/kontakt` - Kontakt

## Konfiguration

Shop-weite Einstellungen befinden sich in `config/shop.php`:
- Shop-Name, Kontaktdaten, Adresse
- Öffnungszeiten
- Social Media Links

In Blade-Templates: `{{ config('shop.name') }}`

## Dokumentation

Weitere Informationen zur Entwicklung finden sich in `CLAUDE.md`.

## Lizenz

Dieses Projekt ist proprietär und nicht zur freien Nutzung bestimmt.
