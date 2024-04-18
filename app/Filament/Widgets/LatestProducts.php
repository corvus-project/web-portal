<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class LatestProducts extends BaseWidget
{
    protected static ?string $heading = 'Latest Products';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()->orderByDESC('id')->limit(10)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('sku'),
                TextColumn::make('name'),
                TextColumn::make('ean'),
                TextColumn::make('stock')->currency(settings()->get('currency')),
                TextColumn::make('price'),
                TextColumn::make('created_at')->dateTime(),
            ]);
    }
}
