<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $fillable= ['name', 'parent_id', 'description', 'slug', 'status', 'image'];

    public static function rules($id){
        return [
            'name' => ["required","string","max:255","min:5",Rule::unique('categories','name')->ignore($id)],
            'parent_id' => ['nullable','int', 'exists:categories,id'],
            'image' => ['image', 'mimes:jpg,png', 'dimensions:min_width:100,min_height:100'],
            'status' => 'required|in:active,archived'
        ];
    }
}
