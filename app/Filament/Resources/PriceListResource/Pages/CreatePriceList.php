<?php

namespace App\Filament\Resources\PriceListResource\Pages;

use App\Filament\Resources\PriceListResource;
use App\Models\ProductPrice;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePriceList extends CreateRecord
{
    protected static string $resource = PriceListResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $model = ProductPrice::updateOrCreate(
            [
                'product_id' => $data['product_id'],
                'customer_id' => $data['customer_id'],
                 
            ], 
            $data);
        return $model;
    }
}
