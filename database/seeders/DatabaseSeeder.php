<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\InventoryLevel;
use App\Models\InventoryLevelStatus;
use App\Models\InventoryLocation;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table(app()->make(InventoryLevelStatus::class)->getTable())->truncate();
        DB::table(app()->make(InventoryLevel::class)->getTable())->truncate();
        DB::table(app()->make(User::class)->getTable())->truncate();
        DB::table(app()->make(ProductPrice::class)->getTable())->truncate();
        DB::table(app()->make(Product::class)->getTable())->truncate();
        DB::table(app()->make(InventoryLocation::class)->getTable())->truncate();
        DB::table(app()->make(Customer::class)->getTable())->truncate();
        InventoryLocation::create(['name' => 'Default']);
        $inventoryLevelStatus =
            [
                ['name' => 'Hand outed', 'description' => 'It shows the number of products with more demand from the customer that is not readily available to supply.'],
                ['name' => 'On hand', 'description' => 'It shows the number of products available to supply.'],
                ['name' => 'Made to Order', 'description' => 'The number of products available in 4-5 days based on confirmed orders.'],
                ['name' => 'Not available', 'description' => 'It shows the temporary unavailability of the product.'],
                ['name' => 'Discontinued', 'description' => 'It shows the product decided by the manufacturer not to produce. Once the current stock goes out, the product will not be available.'],
                ['name' => 'Ready to ship', 'description' => 'It shows the number of products readily available to ship.'],
                ['name' => 'Sold out', 'description' => 'It tells about the number of products consumed because of the demand.'],
                ['name' => 'Temporarily unavailable', 'description' => 'It tells that products are currently unavailable. However, backorders will be taken once products are available to ship.'],
            ];

        $timestamp = Carbon::now();

        foreach ($inventoryLevelStatus as &$record) {
            $record['created_at'] = $timestamp;
            $record['updated_at'] = $timestamp;
        }

        InventoryLevelStatus::insert($inventoryLevelStatus);

        Customer::factory(10)->create();

        Product::factory(10)
                ->hasInventoryLevel(rand(0, 4))
                ->hasProductPrice()
                ->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
