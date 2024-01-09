<?php

namespace App\Filament\Resources\InventoryLevelStatusResource\Pages;

use App\Filament\Resources\InventoryLevelStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryLevelStatus extends EditRecord
{
    protected static string $resource = InventoryLevelStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
