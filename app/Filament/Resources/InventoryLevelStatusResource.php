<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryLevelStatusResource\Pages;
use App\Filament\Resources\InventoryLevelStatusResource\RelationManagers;
use App\Models\InventoryLevelStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class InventoryLevelStatusResource extends Resource
{
    protected static ?string $navigationLabel = 'Inventory Level';
    protected static ?string $model = InventoryLevelStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 40;
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()->columnSpan('full'),
                Forms\Components\Textarea::make('description')
                    ->required()->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->size(TextColumn\TextColumnSize::Large)
                    ->weight(FontWeight::Bold)
                    ->description(fn (InventoryLevelStatus $record): string => $record->description)
                    ->searchable()->wrap()
            ])
            ->filters([
                //
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
            'index' => Pages\ListInventoryLevelStatuses::route('/'),
            'create' => Pages\CreateInventoryLevelStatus::route('/create'),
            'edit' => Pages\EditInventoryLevelStatus::route('/{record}/edit'),
        ];
    }
}
