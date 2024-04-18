<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceListResource\Pages;
use App\Filament\Resources\PriceListResource\RelationManagers;
use App\Models\Customer;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\ProductPrice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceListResource extends Resource
{
    protected static ?int $navigationSort = 10;
    protected static ?string $model = ProductPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(Product::all()->pluck('productDefinition', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->options(Customer::all()->pluck('customerDefinition', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0),
            ])->columns([
                'sm' => 1,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(ProductPrice::query()->with(['customer', 'product']))
            ->columns([
                Tables\Columns\TextColumn::make('product.productDefinition')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.customerDefinition')
                ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->currency(settings()->get('currency'))
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
            'index' => Pages\ListPriceLists::route('/'),
            'create' => Pages\CreatePriceList::route('/create'),
            'edit' => Pages\EditPriceList::route('/{record}/edit'),
        ];
    }
}
