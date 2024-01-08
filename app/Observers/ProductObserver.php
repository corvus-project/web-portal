<?php

namespace App\Observers;

use App\Jobs\SyncPricing;
use App\Jobs\SyncStock;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        SyncPricing::dispatch($product);
        SyncStock::dispatch($product);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('price')) {
            Log::info('Product price updated: from {from} to {to}', ['from' => $product->getOriginal('price'), 'to' => $product->price]);
            SyncPricing::dispatch($product);
        }

        if ($product->isDirty('stock')) {
            SyncStock::dispatch($product);
            Log::info('Product stock updated: from {from} to {to}', ['from' => $product->getOriginal('stock'), 'to' => $product->stock]);
        }
        //Log::info('Product updated: ' . $product->toJson());
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {

    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
