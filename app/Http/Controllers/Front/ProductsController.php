<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        return view('front.products');
    }
    public function show(Product $product){
       if($product->status != 'active'){
        abort(404);
       }
        return view('front.products.show', compact('product'));
    }
}
