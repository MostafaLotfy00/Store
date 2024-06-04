<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products= Product::with(['category', 'store'])->paginate(5);
        return view('back.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //$product= Product::findOrFail($id);
        $categories= Category::all();
        $tags= implode(',', $product->tags()->pluck('name')->toArray());
        
        return view('back.products.edit', compact('product','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));

        $tags= json_decode($request->post('tags'));
        
        $existed_tags= Tag::all();
        $tag_ids=[];
        foreach ($tags as $item){
            $slug= Str::slug($item->value);
            $tag= $existed_tags->where('slug', $slug)->first();
            if(!$tag){
              $tag= Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[]= $tag->id;
        }
        $product->tags()->sync($tag_ids);

        return redirect()->route('dashboard.products.index')->with('success', "Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}
