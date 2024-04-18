<?php

namespace App\Filament\Resources\PriceListResource\Pages;

use App\Filament\Resources\PriceListResource;
use App\Models\ProductPrice;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPriceList extends EditRecord
{
    protected static string $resource = PriceListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    } 

    protected function handleRecordUpdate(Model $record, array $data): Model
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
