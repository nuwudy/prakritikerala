<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Customers';
    protected static string|\UnitEnum|null $navigationGroup = 'Sales';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->unique(ignoreRecord: true)
                ->maxLength(255)
                ->nullable(),
            Forms\Components\TextInput::make('phone')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(20),
            Forms\Components\Textarea::make('address')
                ->rows(3),
            Forms\Components\TextInput::make('city')
                ->maxLength(100),
            Forms\Components\TextInput::make('state')
                ->maxLength(100),
            Forms\Components\TextInput::make('postal_code')
                ->maxLength(20),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
