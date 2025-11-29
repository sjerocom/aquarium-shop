# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is an aquarium e-commerce shop built with Laravel 11 for selling aquarium accessories (plants, shrimp, crabs). Version 1 focuses on admin product management via Filament and public product presentation. Shopping cart and checkout features are planned for v2.

## Tech Stack

- **Framework**: Laravel 11
- **Dev Environment**: Laravel Sail (Docker)
- **Database**: MySQL
- **Frontend**: Blade templates + Livewire
- **Admin Panel**: Filament 3
- **CSS**: Tailwind CSS

## Development Environment

### Starting the Development Environment

```bash
# Start Sail containers
./vendor/bin/sail up -d

# Stop containers
./vendor/bin/sail down
```

### Database Access

MySQL is accessible via Sail:
- **Host**: localhost
- **Port**: 3306
- **User**: sail
- **Password**: password
- **Database**: laravel

### Common Commands

```bash
# Run migrations
./vendor/bin/sail artisan migrate

# Create a migration
./vendor/bin/sail artisan make:migration create_table_name

# Create a model
./vendor/bin/sail artisan make:model ModelName

# Create Filament resources
./vendor/bin/sail artisan make:filament-resource ResourceName --generate

# Create admin user
./vendor/bin/sail artisan make:filament-user
# Default credentials: admin@aquarium-shop.local / Admin123!

# Clear cache
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan view:clear

# Install Composer dependencies
./vendor/bin/sail composer install

# Install/update a package
./vendor/bin/sail composer require package/name
```

## Architecture

### Data Model

The application uses four main product-related models with specific relationships:

**Category** → **Product** (one-to-many)
- Categories have a `type` enum: `plant`, `shrimp`, `crab`
- Each category has a slug for URL routing

**Product** → **ProductAttribute** (one-to-many)
- Product attributes are key-value pairs for type-specific data
- Plant attributes: `light_requirement`, `growth_height`, `growth_speed`, `co2_required`, `difficulty`
- Shrimp/Crab attributes: `temperature_min/max`, `ph_min/max`, `gh_min/max`, `max_size`, `difficulty`, `socialization`

**Product** → **ProductImage** (one-to-many)
- Multiple images per product with `is_primary` flag
- Images sorted by `sort_order`

### Configuration

Shop-wide settings are centralized in `config/shop.php`:
- Shop name, contact details, address
- Opening hours
- Social media links

Access in Blade: `{{ config('shop.name') }}`

### Directory Structure

```
app/
├── Filament/Resources/     # Filament admin resources
├── Http/Controllers/       # Frontend controllers
│   ├── HomeController
│   ├── CategoryController
│   └── ProductController
├── Models/                 # Eloquent models
└── Services/              # Business logic (ProductAttributeService)

resources/views/
├── layouts/shop.blade.php  # Main layout with header/footer
├── home.blade.php          # Homepage
├── category/show.blade.php # Category listing
├── product/show.blade.php  # Product detail
├── pages/                  # Static pages (imprint, contact)
└── components/             # Reusable Blade components
```

### Frontend Routes

- `/` - Homepage with featured products
- `/pflanzen` - Plants category
- `/garnelen` - Shrimp category
- `/krebse` - Crabs category
- `/produkt/{slug}` - Product detail page
- `/impressum` - Legal imprint
- `/kontakt` - Contact page

### Admin Access

Filament admin panel is accessible at `/admin` with credentials created via `make:filament-user`.

## Development Guidelines

### Migrations

Create migrations in the correct order (categories before products) due to foreign key constraints.

### Slug Generation

Use `Str::slug()` in model events to auto-generate slugs from names.

### Image Storage

Product images are stored in `public/products` using Filament's FileUpload component.

### V1 Scope

Version 1 includes:
- Product and category management (admin)
- Public product browsing
- Static pages

**Not included in v1** (buttons should be disabled with tooltips):
- Shopping cart functionality
- Customer registration/login
- Checkout process
- Wishlist
- Product reviews
- Payment integration

### V2 Roadmap

Prepared database tables for future features:
- Carts and CartItems
- Orders
- Reviews
