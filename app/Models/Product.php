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

    public function scopeActive(Builder $builder){
        $builder->where('status', 'active');
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
