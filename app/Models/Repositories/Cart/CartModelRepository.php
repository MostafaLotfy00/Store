<?php

namespace App\Models\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartModelRepository implements CartRepository{

    public function get() : Collection{
        return Cart::with('product')->get();
    }

    public function add(Product $product, $quantity = 1){
        $cart= Cart::where('product_id', $product->id)->first();

        if($cart){
            return $cart->increment('quantity', $quantity);
            // $cart->quantity += $quantity;
            // $cart->save(); 
            // return $cart;
        }
      return  Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }
    public function update(Product $product, $quantity): void
    {
        Cart::where('product_id', $product->id)
        ->update([
            'quantity' => $quantity,
        ]);
    }

    public function delete($id): void{
        Cart::where('id', $id)
        ->delete();
    }

    public function clear(): void
    {
        Cart::truncate();
    }
    public function total()
    {
    //    return Cart::join('products', 'products.id', '=', 'carts.product_id')
    //     ->selectRaw('SUM(products.price * carts.quantity) as total')
    //     ->value('total');
    return Cart::get()->sum(function($item){
        return $item->product->price * $item->quantity;
    });
    }

    

}