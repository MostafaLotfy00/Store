<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable= ['name', 'parent_id', 'description', 'slug', 'status', 'image'];

    public function scopeActive(Builder $builder){
        $builder->where('status', 'active');
    }
    public function scopeStatus(Builder $builder, $status){
        $builder->where('status', $status);
    }

    public function scopeFilter(Builder $builder, $filters){

        $builder->when($filters['name'] ?? false, function($query, $value){
            $query->where('name', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function($query, $value){
            $query->where('status', $value);
        });
    
    }

    public function category(){
        return $this->belongsTo(Category::class,'parent_id');
    }
    public static function rules($id){
        return [
            'name' => ["required","string","max:255","min:5",Rule::unique('categories','name')->ignore($id)],
            'parent_id' => ['nullable','int', 'exists:categories,id'],
            'image' => ['image', 'mimes:jpg,png', 'dimensions:min_width:100,min_height:100'],
            'status' => 'required|in:active,archived'
        ];
    }
}
