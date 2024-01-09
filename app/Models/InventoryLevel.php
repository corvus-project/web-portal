<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class InventoryLevel extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(InventoryLocation::class, 'inventory_location_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(InventoryLevelStatus::class, 'inventory_level_status_id', 'id');
    }


    protected function locationName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes,
        );
    }
    

}
