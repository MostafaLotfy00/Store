<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    protected $hidden =[
        'created_at', 'updated_at', 'deleted_at', 'category_id', 'store_id', 'image'
    ];
    protected $appends= ['image_url'];
    public function scopeActive(Builder $builder){
        $builder->where('status', 'active');
    }

    public function scopeFilter(Builder $builder, $filters){
        $options= array_merge([
            'category_id' => null,
            'store_id'=> null,
            'tag_id' => null,
            'status' => 'active',
        ],$filters);

        $builder->when($options['status'], function($builder, $value){
            $builder->where('status', $value);
        });
        $builder->when($options['category_id'], function($builder, $value){
            $builder->where('category_id', $value);
        });
        $builder->when($options['store_id'], function($builder, $value){
            $builder->where('store_id', $value);
        });
        $builder->when($options['tag_id'], function($builder, $value){
            $builder->whereHas('tags', function($builder) use ($value) {
                $builder->where('id', $value);
            });
        });
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    protected static function booted()
    {
        static::creating(function(Product $product){
            $product->slug= Str::slug($product->name);
        });
        static::updating(function(Product $product){
            $product->slug= Str::slug($product->name);
        });
        static::addGlobalScope('store',new StoreScope);
    }
   
    
    #ACCESSORS
    public function getImageUrlAttribute(){
        if(!$this->image){
            return 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1200px-No-Image-Placeholder.svg.png';
        }

        if(Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('uploads/'. $this->image);
    }

    public function getSalePercentAttribute() : int{
        if($this->compare_price){
            $discount= ($this->compare_price - $this->price) / $this->compare_price * 100;
            return $discount;
        }
    }
}
