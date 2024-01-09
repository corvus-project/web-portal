<?php

namespace Database\Factories;

use App\Models\InventoryLevel;
use App\Models\InventoryLevelStatus;
use App\Models\InventoryLocation;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->catchPhrase(),
            'sku' => $this->faker->unique()->ean8(),
            'barcode' => $this->faker->ean13(),
            'price' => $this->faker->randomFloat(2,1,1000),
            'stock' => $this->faker->randomNumber(2),
            'description' => $this->faker->realText(),
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
