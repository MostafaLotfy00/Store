<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('back.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        return view('back.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data= $request->validated();
        $data['slug'] = Str::slug($request->post('name'));
        $path = $this->uploadImage($request);
        $data['image'] = $path;

        $category = Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('create-status', "Category Added Successfully");
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', '<>', $id)
                    ->orwhereNull('parent_id');
            })->get();
        return view('back.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(CategoryRequest $request, string $id)
    {
        $data= $request->validated();
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data['image'] = $this->uploadImage($request);
            
            if($data['image'] == null){
                unset($data['image']);
            }

            $category->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('uploads')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')->with('create-status', "Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image) {
            Storage::disk('uploads')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.index')->with('create-status', "Category Deleted Successfully");
    }

    protected function uploadImage($request)
    {

        if (!$request->hasFile('image')) {
            return;
        }
        $image = $request->file('image');
        $path = $image->store('categories', 'uploads');
        return $path;
    }
}
