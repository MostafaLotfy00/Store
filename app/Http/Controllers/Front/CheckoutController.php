<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create()
    {
    //    dd(Order::with('detail','products')->first());
        $cart = App::make('cart');
        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }
        $countries= Countries::getNames();
        return view('front.checkout', compact('cart', 'countries'));
    }
    public function store(Request $request)
    {
        $request->validate([]);
        $cart = App::make('cart');
        $items = $cart->get()->groupBy('product.store_id')->all();
        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod'
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'product_price' => $item->product->price,
                        'quantity' => $item->quantity
                    ]);
                }
                foreach ($request->post('address') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }

            DB::commit();
            event(new OrderCreated($order));
           
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        $cart->clear();
        return redirect()->route('home');
    }
}
