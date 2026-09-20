<?php

namespace App\Listeners;

use App\Events\CancelOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RestoreStockListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CancelOrderEvent $event): void
    {
        $order = $event->order;

        // Restore stock for each product in the canceled order
        foreach ($order->products as $product) {
            $product->stock += $product->pivot->quantity;
            $product->save();
        }
    }
}
