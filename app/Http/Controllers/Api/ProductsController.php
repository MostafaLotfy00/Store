<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Product::with(['category:id,name', 'store:id,name'])->filter($request->query())->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => ['required', 'string', 'unique:products,name' ,'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => 'required|exists:categories,id',
            'status' => 'in:active,archived',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price'
        ]);
        $data= $request->all();

        if($request->hasFile('image')){
            $image= $request->file('image');
            $path=$image->store('products', 'uploads');
            $data['image']= $path;
        }
        $product= Product::create($data);
        return $product;

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product= Product::find($id);
        if(!$product){
            return Response::json([
                'message' => 'Product not found',
            ], 404);
        }
        return Response::json($product->load('category:id,name','store:id,name'), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product= Product::find($id);
        if(!$product){
            return Response::json([
                'message' => 'Product not found',
            ], 404);
        }
        $request->validate([
            'name' => ['sometimes','required','string', 'max:255', Rule::unique(Product::class)->ignore($id)],
            'description' => ['nullable', 'string'],
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'in:active,archived',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'price' => 'sometimes|require|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price'
        ]);
        $data= $request->all();
        if($request->hasFile('image')){
            $image= $request->file('image');
            $path=$image->store('products', 'uploads');
            $data['image']= $path;
        }
        $product->update($data);
        return Response::json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return Response::json([
            'message' => 'Product deleted successfully'
        ],200);
    }
}
