<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\PriceListResource;
use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\Page;

use App\Models\InventoryLevel;
use App\Models\Product;
use App\Models\ProductPrice;
use Filament\Actions;


use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\Action;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PriceList extends Page  implements HasTable
{
    use InteractsWithTable;
    protected static string $resource = ProductResource::class;

    protected static string $view = 'filament.resources.product-resource.pages.price-list';


    public $product;

    public function mount($record)
    {
        $this->product = Product::find($record);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ProductPrice::query()
                    ->where('product_id', $this->product->id)
                    ->with(['customer'])
            )
            ->columns([
                TextColumn::make('product.sku')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')

            ])
            ->filters([
                SelectFilter::make('inventory_level_status_id')

            ])
            ->actions([
                //EditAction::make(),

                Action::make('pricing')
                    ->url(fn ($record): string => PriceListResource::getUrl('edit',  ['record' => $record->id]))
                    ->label('Update'),
            ]);
    }
}
