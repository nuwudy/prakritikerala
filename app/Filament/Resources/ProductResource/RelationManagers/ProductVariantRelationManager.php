<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\ProductVariant;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProductVariantRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';
    protected static ?string $recordTitleAttribute = 'sku';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('weight')
                ->label('Weight')
                ->required()
                ->placeholder('e.g., 250g, 1kg'),
            Forms\Components\TextInput::make('price')
                ->label('Price')
                ->numeric()
                ->required()
                ->prefix('₹'),
            Forms\Components\TextInput::make('sku')
                ->label('SKU')
                ->unique(table: ProductVariant::class, column: 'sku', ignoreRecord: true)
                ->required(),
            Forms\Components\TextInput::make('stock')
                ->label('Stock')
                ->numeric()
                ->default(0),
            Forms\Components\Toggle::make('is_default')
                ->label('Default Variant')
                ->default(false),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('weight'),
                Tables\Columns\TextColumn::make('price')->money('INR', true),
                Tables\Columns\TextColumn::make('sku'),
                Tables\Columns\TextColumn::make('stock'),
                Tables\Columns\BooleanColumn::make('is_default'),
            ])
            ->filters([])
            ->headerActions([
                \Filament\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }
}
