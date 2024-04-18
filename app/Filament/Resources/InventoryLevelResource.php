<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryLevelResource\Pages;
use App\Filament\Resources\InventoryLevelResource\RelationManagers;
use App\Models\InventoryLevel;
use App\Models\InventoryLevelStatus;
use App\Models\InventoryLocation;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryLevelResource extends Resource
{
    protected static ?string $model = InventoryLevel::class;

    protected static ?string $navigationLabel = 'Inventory';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(Product::all()->pluck('productDefinition', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('inventory_location_id')
                    ->label('Location')
                    ->options(InventoryLocation::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),


                Forms\Components\Select::make('inventory_level_status_id')
                    ->label('Level Status')
                    ->options(InventoryLevelStatus::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('available')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(InventoryLevel::query()->with(['location', 'status', 'product']))
            ->columns([
                Tables\Columns\TextColumn::make('product.product_definition')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('available')
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('inventory_level_status_id')
                    ->label('Inventory Level Status')
                    ->relationship(
                        'status',
                        'name'
                    ),

                Tables\Filters\SelectFilter::make('inventory_location_id')
                    ->label('Location')
                    ->relationship(
                        'location',
                        'name'
                    ),
                Tables\Filters\SelectFilter::make('product_id')
                    ->label('Product')
                    ->searchable()
                    ->options(
                        Product::all()->pluck('product_definition', 'id')
                    )


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListInventoryLevels::route('/'),
            'create' => Pages\CreateInventoryLevel::route('/create'),
            'edit' => Pages\EditInventoryLevel::route('/{record}/edit'),
        ];
    }
}
