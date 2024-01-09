<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\InventoryLevelResource;
use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class Inventory extends ListRecords
{
    protected static string $resource = InventoryLevelResource::class;

    protected static ?string $title = 'Product Inventory List';   

    
}
