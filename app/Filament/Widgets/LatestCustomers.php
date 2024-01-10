<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class LatestCustomers extends BaseWidget
{
    protected static ?string $heading = 'Latest Customers';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Customer::query()->orderByDESC('id')->limit(10)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('account_code'),
                TextColumn::make('name'),
                TextColumn::make('created_at')->dateTime(),
            ]);
    }
}
