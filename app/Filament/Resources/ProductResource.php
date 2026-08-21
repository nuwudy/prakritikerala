<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Products';
    protected static string|\UnitEnum|null $navigationGroup = 'Catalog';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (callable $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                Forms\Components\TextInput::make('slug')
                    ->unique(table: Product::class, column: 'slug', ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->toolbarButtons([
                        'blockquote', 'bold', 'bulletList', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                    ])
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('ingredients')
                    ->toolbarButtons([
                        'bold', 'bulletList', 'italic', 'redo', 'undo',
                    ])
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('how_to_use')
                    ->toolbarButtons([
                        'bold', 'bulletList', 'italic', 'orderedList', 'redo', 'undo',
                    ])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('seo_title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('seo_description')
                    ->rows(3),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                Forms\Components\TextInput::make('picked_for_you_order')
                    ->numeric()
                    ->label('Picked For You Order (1 is first)'),
                \Awcodes\Curator\Components\Forms\CuratorPicker::make('image')
                    ->label('Primary Image'),
                \Awcodes\Curator\Components\Forms\CuratorPicker::make('images')
                    ->label('Gallery Images')
                    ->multiple(),
                \Awcodes\Curator\Components\Forms\CuratorPicker::make('video_url')
                    ->label('Product Video')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg']),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('categories.name')->label('Categories')->searchable()->badge(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('picked_for_you_order')->sortable(),
                \Awcodes\Curator\Components\Tables\CuratorColumn::make('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple(),
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductVariantRelationManager::class,
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
