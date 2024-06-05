<?php

namespace App\Listeners;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;

class DuductProductQuantity
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
    public function handle($event)
    {
       // $cart= App::make('cart');
       $order= $event->order;
        foreach($order->products as $product){
            $product->decrement('quantity', $product->pivot->quantity);
            // Product::where('id', $item->product_id)->update([
            //     'quantity' => $item->product->quantity - $item->quantity,
            // ]);
        }
    }
}
