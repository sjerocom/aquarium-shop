<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Produkte';

    protected static ?string $modelLabel = 'Produkt';

    protected static ?string $pluralModelLabel = 'Produkte';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basis-Informationen')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Kategorie')
                            ->options(Category::where('is_active', true)->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false),

                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            ),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        Forms\Components\TextInput::make('latin_name')
                            ->label('Lateinischer Name')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Beschreibung')
                            ->required()
                            ->maxLength(65535)
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Preis & Lagerbestand')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Preis')
                            ->required()
                            ->numeric()
                            ->prefix('€')
                            ->step(0.01)
                            ->minValue(0),

                        Forms\Components\TextInput::make('stock')
                            ->label('Lagerbestand')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktiv')
                            ->default(true)
                            ->required(),

                        Forms\Components\Toggle::make('requires_special_shipping')
                            ->label('Tierversand erforderlich')
                            ->helperText('Für lebende Tiere (Garnelen, Krebse)')
                            ->default(false)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategorie')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('latin_name')
                    ->label('Lat. Name')
                    ->searchable()
                    ->toggleable()
                    ->italic()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Preis')
                    ->money('EUR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Bestand')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state < 10 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\IconColumn::make('requires_special_shipping')
                    ->label('Tierversand')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktiv')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Erstellt am')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Aktualisiert am')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategorie')
                    ->relationship('category', 'name'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktiv')
                    ->placeholder('Alle')
                    ->trueLabel('Aktiv')
                    ->falseLabel('Inaktiv'),

                Tables\Filters\TernaryFilter::make('requires_special_shipping')
                    ->label('Tierversand')
                    ->placeholder('Alle')
                    ->trueLabel('Ja')
                    ->falseLabel('Nein'),

                Tables\Filters\Filter::make('low_stock')
                    ->label('Niedriger Bestand')
                    ->query(fn ($query) => $query->where('stock', '<', 10)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AttributesRelationManager::class,
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
