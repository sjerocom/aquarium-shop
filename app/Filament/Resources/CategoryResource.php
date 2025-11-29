<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Kategorien';

    protected static ?string $modelLabel = 'Kategorie';

    protected static ?string $pluralModelLabel = 'Kategorien';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->unique(Category::class, 'slug', ignoreRecord: true),

                Forms\Components\Select::make('type')
                    ->label('Typ')
                    ->options([
                        'plant' => 'Pflanzen',
                        'shrimp' => 'Garnelen',
                        'crab' => 'Krebse',
                    ])
                    ->required()
                    ->native(false),

                Forms\Components\Textarea::make('description')
                    ->label('Beschreibung')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('image')
                    ->label('Bild')
                    ->image()
                    ->directory('categories')
                    ->maxSize(2048),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktiv')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Bild')
                    ->size(50)
                    ->defaultImageUrl(url('/images/placeholder.png')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Typ')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'plant' => 'Pflanzen',
                        'shrimp' => 'Garnelen',
                        'crab' => 'Krebse',
                        default => $state,
                    })
                    ->colors([
                        'success' => 'plant',
                        'info' => 'shrimp',
                        'warning' => 'crab',
                    ]),

                Tables\Columns\TextColumn::make('products_count')
                    ->label('Anzahl Produkte')
                    ->counts('products')
                    ->sortable(),

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
                Tables\Filters\SelectFilter::make('type')
                    ->label('Typ')
                    ->options([
                        'plant' => 'Pflanzen',
                        'shrimp' => 'Garnelen',
                        'crab' => 'Krebse',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktiv')
                    ->placeholder('Alle')
                    ->trueLabel('Aktiv')
                    ->falseLabel('Inaktiv'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
