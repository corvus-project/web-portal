<?php

namespace Database\Factories;

use App\Models\InventoryLevelStatus;
use App\Models\InventoryLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryLevel>
 */
class InventoryLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = InventoryLocation::inRandomOrder()->first();
        $inventory_level_status = InventoryLevelStatus::inRandomOrder()->first();

        return [
            'inventory_location_id' => $location->id,
            'inventory_level_status_id' => $inventory_level_status->id,
            'available' => rand(10000, 365)
        ];
    }
}
