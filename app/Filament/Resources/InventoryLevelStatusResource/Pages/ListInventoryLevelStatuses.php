<?php

namespace App\Filament\Resources\InventoryLevelStatusResource\Pages;

use App\Filament\Resources\InventoryLevelStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryLevelStatuses extends ListRecords
{
    protected static string $resource = InventoryLevelStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
