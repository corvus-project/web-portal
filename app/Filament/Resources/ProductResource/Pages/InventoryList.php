<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\InventoryLevelResource;
use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use App\Models\InventoryLevel;
use App\Models\Product;

use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InventoryList extends Page  implements HasTable
{
    use InteractsWithTable;
    protected static string $resource = ProductResource::class;

    protected static string $view = 'filament.resources.product-resource.pages.inventory-list';

    public $product;

    public function mount($record)
    {
        $this->product = Product::find($record);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                    InventoryLevel::query()
                        ->where('product_id', $this->product->id)
                        ->with(['location', 'status', 'product'])
                        )
            ->columns([
                TextColumn::make('product.sku')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location.name')
                    ->sortable(),
                TextColumn::make('status.name')
                    ->sortable(),
                TextColumn::make('available')
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('inventory_level_status_id')
                    ->relationship(
                        'status',
                        'name'
                    ),

                SelectFilter::make('inventory_location_id')
                    ->relationship(
                        'location',
                        'name'
                    ),
            ])
            ->actions([
                //EditAction::make(),
                Action::make('inventory')
                ->url(fn ($record): string => InventoryLevelResource::getUrl('edit',  ['record' => $record->id]))
                ->label('Update'),
            ])
;
    }
}
