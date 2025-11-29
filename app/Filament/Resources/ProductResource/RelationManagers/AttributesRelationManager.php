<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'attributes';

    protected static ?string $title = 'Attribute';

    protected static ?string $recordTitleAttribute = 'key';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('key')
                    ->label('Attribut')
                    ->options([
                        // Pflanzen-Attribute
                        'light_requirement' => 'Lichtbedarf',
                        'growth_height' => 'Wuchshöhe',
                        'growth_speed' => 'Wachstumsgeschwindigkeit',
                        'co2_required' => 'CO2 erforderlich',
                        // Tier-Attribute
                        'temperature_min' => 'Temperatur Min',
                        'temperature_max' => 'Temperatur Max',
                        'ph_min' => 'pH-Wert Min',
                        'ph_max' => 'pH-Wert Max',
                        'gh_min' => 'GH Min',
                        'gh_max' => 'GH Max',
                        'max_size' => 'Maximale Größe',
                        'socialization' => 'Vergesellschaftung',
                        // Allgemein
                        'difficulty' => 'Schwierigkeitsgrad',
                    ])
                    ->required()
                    ->searchable()
                    ->native(false),

                Forms\Components\TextInput::make('value')
                    ->label('Wert')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('key')
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Attribut')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'light_requirement' => 'Lichtbedarf',
                        'growth_height' => 'Wuchshöhe',
                        'growth_speed' => 'Wachstumsgeschwindigkeit',
                        'co2_required' => 'CO2 erforderlich',
                        'temperature_min' => 'Temperatur Min',
                        'temperature_max' => 'Temperatur Max',
                        'ph_min' => 'pH-Wert Min',
                        'ph_max' => 'pH-Wert Max',
                        'gh_min' => 'GH Min',
                        'gh_max' => 'GH Max',
                        'max_size' => 'Maximale Größe',
                        'difficulty' => 'Schwierigkeitsgrad',
                        'socialization' => 'Vergesellschaftung',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Wert')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Erstellt am')
                    ->dateTime('d.m.Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
