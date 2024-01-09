<?php

namespace App\Observers;

use App\Jobs\SyncPricing;
use App\Jobs\SyncStock;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    private function  dispatchSyncPricing(Product $product)
    {
        //SyncPricing::dispatch($product);
    }

    private function  dispatchSyncStock(Product $product)
    {
        //SyncStock::dispatch($product);
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $this->dispatchSyncStock($product);
        $this->dispatchSyncPricing($product);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('price')) {
            Log::info('Product price updated: from {from} to {to}', ['from' => $product->getOriginal('price'), 'to' => $product->price]);
            $this->dispatchSyncPricing($product);
        }

        if ($product->isDirty('stock')) {
            Log::info('Product stock updated: from {from} to {to}', ['from' => $product->getOriginal('stock'), 'to' => $product->stock]);
            $this->dispatchSyncStock($product);
        }
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
