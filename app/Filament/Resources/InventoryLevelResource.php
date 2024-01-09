<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryLevelResource\Pages;
use App\Filament\Resources\InventoryLevelResource\RelationManagers;
use App\Models\InventoryLevel;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('inventory_location_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('inventory_level_status_id')
                    ->required()
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('product.sku')
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
                    ->relationship(
                        'status',
                        'name'
                    ),

                Tables\Filters\SelectFilter::make('inventory_location_id')
                    ->relationship(
                        'location',
                        'name'
                    ),
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
