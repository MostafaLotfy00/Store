<?php

namespace App\Models\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository{

    public function get() : Collection;
    public function add(Product $product, $quantity= 1) ;
    public function update(Product $product, $quantity) : void;
    public function delete($id) : void;
    public function clear() : void;
    public function total() ;


}