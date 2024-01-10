<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['account_code', 'name']; 
    public function customerPrice()
    {
        return $this->hasMany(ProductPrice::class);
    }

    
    protected function customerDefinition(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['account_code'] .", ". $attributes['name'],
        );
    }
}
