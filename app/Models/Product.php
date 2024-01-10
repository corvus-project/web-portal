<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'name', 'price', 'stock', 'sku', 'barcode', 'description', 'published_at'];

    public function inventoryLevel()
    {
        return $this->hasMany(InventoryLevel::class);
    }

    
    public function productPrice()
    {
        return $this->hasMany(ProductPrice::class);
    }

    protected function productDefinition(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['sku'] .", ". $attributes['name'],
        );
    }

}
