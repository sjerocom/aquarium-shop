# Aquarium-Shop – Laravel Projekt v1

## Projektziel

Online-Shop für Aquarium-Zubehör (Pflanzen, Garnelen, Krebse) mit Laravel 11. Version 1 fokussiert auf Admin-Produktverwaltung und öffentliche Produktpräsentation.

---

## Tech-Stack

| Komponente | Technologie |
|------------|-------------|
| Framework | Laravel 11 |
| Dev-Environment | Laravel Sail (Docker) |
| Datenbank | MySQL |
| Frontend | Blade + Livewire |
| Admin-Panel | Filament 3 |
| IDE | PhpStorm + DataGrip |

---

## Setup-Befehle

```bash
# Projekt erstellen
curl -s "https://laravel.build/aquarium-shop?with=mysql" | bash
cd aquarium-shop

# Sail starten
./vendor/bin/sail up -d

# Filament installieren
./vendor/bin/sail composer require filament/filament:"^3.0"
./vendor/bin/sail artisan filament:install --panels

# Admin-User erstellen (nach Migration)
./vendor/bin/sail artisan make:filament-user
# Email: admin@aquarium-shop.local
# Name: Admin
# Password: Admin123!
```

---

## DataGrip Verbindung

| Feld | Wert |
|------|------|
| Host | localhost |
| Port | 3306 |
| User | sail |
| Password | password |
| Database | laravel |

---

## Zentrale Konfiguration

Datei: `config/shop.php`

```php
<?php

return [
    'name' => 'Aquarium Shop',
    'email' => 'info@aquarium-shop.local',
    'phone' => '+43 123 456789',
    'address' => [
        'street' => 'Musterstraße 1',
        'zip' => '1010',
        'city' => 'Wien',
        'country' => 'Österreich',
    ],
    'opening_hours' => 'Mo-Fr 9:00-18:00',
    'social' => [
        'facebook' => null,
        'instagram' => null,
    ],
];
```

Zugriff in Blade: `{{ config('shop.name') }}`

---

## Datenmodell

### Categories

| Feld | Typ | Beschreibung |
|------|-----|--------------|
| id | bigint | PK |
| name | string | Kategoriename |
| slug | string | URL-Slug |
| type | enum | `plant`, `shrimp`, `crab` |
| description | text | nullable |
| image | string | nullable |
| is_active | boolean | default true |
| timestamps | | |

### Products

| Feld | Typ | Beschreibung |
|------|-----|--------------|
| id | bigint | PK |
| category_id | foreignId | FK zu categories |
| name | string | Produktname |
| slug | string | URL-Slug |
| latin_name | string | nullable, wissenschaftlicher Name |
| description | text | |
| price | decimal(10,2) | |
| stock | integer | Lagerbestand |
| is_active | boolean | default true |
| requires_special_shipping | boolean | default false |
| timestamps | | |

### ProductAttributes (für typspezifische Daten)

| Feld | Typ | Beschreibung |
|------|-----|--------------|
| id | bigint | PK |
| product_id | foreignId | FK zu products |
| key | string | Attributname |
| value | string | Attributwert |
| timestamps | | |

**Vordefinierte Attribute nach Typ:**

**Pflanzen:**
- `light_requirement` (niedrig/mittel/hoch)
- `growth_height` (cm)
- `growth_speed` (langsam/mittel/schnell)
- `co2_required` (boolean)
- `difficulty` (anfänger/fortgeschritten/experte)

**Garnelen/Krebse:**
- `temperature_min` (°C)
- `temperature_max` (°C)
- `ph_min`
- `ph_max`
- `gh_min`
- `gh_max`
- `max_size` (cm)
- `difficulty` (anfänger/fortgeschritten/experte)
- `socialization` (Einzelhaltung/Gruppe/Artenbecken)

### ProductImages

| Feld | Typ | Beschreibung |
|------|-----|--------------|
| id | bigint | PK |
| product_id | foreignId | FK zu products |
| path | string | Bildpfad |
| is_primary | boolean | default false |
| sort_order | integer | default 0 |
| timestamps | | |

### Users (Laravel Standard + Erweiterung)

| Feld | Typ | Beschreibung |
|------|-----|--------------|
| ... | | Laravel Standard |
| is_admin | boolean | default false |

### Vorbereitet für v2

**Carts**
| Feld | Typ |
|------|-----|
| id | bigint |
| user_id | foreignId nullable |
| session_id | string nullable |
| timestamps | |

**CartItems**
| Feld | Typ |
|------|-----|
| id | bigint |
| cart_id | foreignId |
| product_id | foreignId |
| quantity | integer |
| timestamps | |

**Orders** (Struktur vorbereiten, nicht implementieren)

**Reviews** (Struktur vorbereiten, nicht implementieren)

---

## Filament Admin Resources

Zu erstellen:

```bash
./vendor/bin/sail artisan make:filament-resource Category --generate
./vendor/bin/sail artisan make:filament-resource Product --generate
```

### CategoryResource

- Felder: name, slug (auto-generate), type (Select), description, image (FileUpload), is_active (Toggle)
- Slug automatisch aus name generieren

### ProductResource

- Felder: alle aus Datenmodell
- Relation Manager für ProductAttributes
- Relation Manager für ProductImages
- Filter nach Kategorie, Typ, Aktiv-Status

---

## Frontend Routen

| Route | View | Beschreibung |
|-------|------|--------------|
| `/` | home | Startseite mit Featured Produkten |
| `/pflanzen` | category | Alle Pflanzen |
| `/garnelen` | category | Alle Garnelen |
| `/krebse` | category | Alle Krebse |
| `/produkt/{slug}` | product.show | Produktdetailseite |
| `/impressum` | pages.imprint | Statisch |
| `/kontakt` | pages.contact | Statisch |

---

## Frontend Views

### Layout (`resources/views/layouts/shop.blade.php`)

- Header mit Logo, Navigation (Kategorien), Shop-Name aus Config
- Footer mit Kontaktdaten aus Config, Impressum-Link

### Startseite

- Hero-Bereich
- 3 Kategorie-Kacheln (Pflanzen, Garnelen, Krebse)
- Neueste Produkte (letzte 6)

### Kategorieseite

- Kategorie-Header mit Beschreibung
- Produktgrid (Bild, Name, Preis)
- "In den Warenkorb"-Button (disabled, Tooltip: "Demnächst verfügbar")

### Produktdetailseite

- Bildergalerie
- Name, Lateinischer Name
- Preis
- Beschreibung
- Attribut-Tabelle (je nach Typ)
- Lagerbestand-Anzeige
- Hinweis bei `requires_special_shipping`: "Lebendtier – Spezialversand"
- "In den Warenkorb"-Button (disabled)
- "Auf Wunschliste"-Button (disabled)

---

## Verzeichnisstruktur

```
app/
├── Filament/
│   └── Resources/
│       ├── CategoryResource.php
│       └── ProductResource.php
├── Http/
│   └── Controllers/
│       ├── HomeController.php
│       ├── CategoryController.php
│       └── ProductController.php
├── Models/
│   ├── Category.php
│   ├── Product.php
│   ├── ProductAttribute.php
│   ├── ProductImage.php
│   └── User.php
└── Services/
    └── ProductAttributeService.php

resources/views/
├── layouts/
│   └── shop.blade.php
├── home.blade.php
├── category/
│   └── show.blade.php
├── product/
│   └── show.blade.php
├── pages/
│   ├── imprint.blade.php
│   └── contact.blade.php
└── components/
    ├── product-card.blade.php
    └── attribute-table.blade.php
```

---

## v1 Deliverables Checkliste

- [ ] Laravel Projekt mit Sail aufsetzen
- [ ] MySQL Datenbank konfiguriert
- [ ] `config/shop.php` erstellt
- [ ] Migrations für alle Tabellen
- [ ] Models mit Relationships
- [ ] Filament installiert
- [ ] Admin-User (admin@aquarium-shop.local / Admin123!)
- [ ] CategoryResource mit CRUD
- [ ] ProductResource mit CRUD + Attribute + Images
- [ ] Frontend Layout
- [ ] Startseite
- [ ] Kategorieseiten (3x)
- [ ] Produktdetailseite
- [ ] Impressum & Kontakt
- [ ] Disabled Warenkorb/Wunschliste Buttons

---

## v2 Roadmap (nicht in v1)

- Kunden-Registrierung & Login
- Warenkorb-Funktionalität
- Checkout-Flow
- PayPal-Integration
- Versandkostenberechnung
- Wunschliste
- Bewertungen & Rezensionen
- Git-Repository
- CI/CD Pipeline
- Deployment auf Strato VPS

---

## Hinweise für Umsetzung

1. Migrations in korrekter Reihenfolge erstellen (categories vor products)
2. Seeders für Testkategorien anlegen
3. Slug-Generation via `Str::slug()` in Model-Events
4. Bilder-Upload via Filament FileUpload, Storage in `public/products`
5. Tailwind CSS für Frontend-Styling (kommt mit Laravel)
6. Livewire nur wo nötig (z.B. später Warenkorb)
