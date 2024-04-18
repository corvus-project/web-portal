<?php

namespace App\Filament\Resources\InventoryLevelResource\Pages;

use App\Filament\Resources\InventoryLevelResource;
use App\Models\InventoryLevel;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateInventoryLevel extends CreateRecord
{
    protected static string $resource = InventoryLevelResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $model = InventoryLevel::updateOrCreate(
            [
                'product_id' => $data['product_id'],
                'inventory_location_id' => $data['inventory_location_id'],
                'inventory_level_status_id' => $data['inventory_level_status_id'],
            ], 
            $data);
        return $model;
    }
}
