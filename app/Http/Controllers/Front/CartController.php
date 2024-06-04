<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Repositories\Cart\CartModelRepository;

class CartController extends Controller
{
    protected $cart;
    public function __construct()
    {
        $this->cart= APP::make('cart');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repository=  $this->cart;
        $items= $repository->get();
        $total= $repository->total();
        return view('front.cart.index', compact('items','total'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'quantity' => 'nullable|int|min:1',
        ]);
        $repository= $this->cart;
        $product= Product::find($request->post('product_id'));
        $repository->add($product, $request->post('quantity'));

        return redirect()->route('cart.index')->with('success', 'Product added successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'quantity' => 'nullable|int|min:1',
        ]);
        $repository= $this->cart;
        $product= Product::find($request->post('product_id'));
        $repository->update($product, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $repository= $this->cart;
        $repository->delete($id);

        return back()->with('success', 'Item deleted successfully');
    }
}
