<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopSettingResource\Pages;
use App\Models\ShopSetting;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ShopSettingResource extends Resource
{
    protected static ?string $model = ShopSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Shop & Delivery Settings';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('shop_name')
                    ->label('Store / Brand Name')
                    ->required()
                    ->default('Prakriti Kerala'),

                Forms\Components\Textarea::make('warehouse_address')
                    ->label('Warehouse Physical Address')
                    ->placeholder('e.g. Building No 12, MG Road, Kochi, Kerala 682016')
                    ->rows(2)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('latitude')
                    ->label('Warehouse Latitude')
                    ->numeric()
                    ->required()
                    ->helperText('e.g. 9.9312328'),

                Forms\Components\TextInput::make('longitude')
                    ->label('Warehouse Longitude')
                    ->numeric()
                    ->required()
                    ->helperText('e.g. 76.2673041'),

                Forms\Components\Toggle::make('enable_free_delivery')
                    ->label('Enable Free Local Delivery')
                    ->default(true)
                    ->helperText('When enabled, orders within the specified radius get 100% free delivery.'),

                Forms\Components\TextInput::make('free_delivery_radius_km')
                    ->label('Free Delivery Radius')
                    ->numeric()
                    ->suffix('km')
                    ->default(3.00)
                    ->helperText('Free delivery distance radius in kilometers.'),

                Forms\Components\TextInput::make('standard_shipping_fee')
                    ->label('Standard Shipping Fee (Outside Free Radius)')
                    ->numeric()
                    ->prefix('₹')
                    ->default(50.00)
                    ->helperText('Fallback delivery fee charged outside the free radius zone.'),

                Forms\Components\Toggle::make('enable_cod')
                    ->label('Enable Cash on Delivery (COD)')
                    ->default(true)
                    ->helperText('Allow customers to choose Cash on Delivery at checkout.'),

                Forms\Components\TextInput::make('cod_extra_charge')
                    ->label('COD Extra Charge')
                    ->numeric()
                    ->prefix('₹')
                    ->default(0.00)
                    ->helperText('Optional extra charge for COD orders. Set 0 for free COD.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shop_name')->label('Store Name'),
                Tables\Columns\TextColumn::make('warehouse_address')->label('Address')->limit(30),
                Tables\Columns\TextColumn::make('latitude')->label('Latitude'),
                Tables\Columns\TextColumn::make('longitude')->label('Longitude'),
                Tables\Columns\TextColumn::make('free_delivery_radius_km')->label('Free Radius (km)'),
                Tables\Columns\IconColumn::make('enable_free_delivery')->boolean()->label('Free Delivery'),
                Tables\Columns\IconColumn::make('enable_cod')->boolean()->label('COD Enabled'),
            ])
            ->filters([])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShopSettings::route('/'),
            'edit' => Pages\EditShopSetting::route('/{record}/edit'),
        ];
    }
}
