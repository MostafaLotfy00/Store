<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Cart extends Model
{
    use HasFactory;
    
    public $incrementing = false;

    protected $guarded= [];

    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

    protected static function booted(){
        // static::creating(function(Cart $cart){
        //     $cart->id= Str::uuid();
        // });
        static::observe(CartObserver::class);
        static::addGlobalScope('cookie_id', function(Builder $builder){
            $builder->where('cookie_id', self::getCookieId());
        });
    }

    public static function getCookieId(){
        $cookie_id= Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id= Str::uuid();
            Cookie::queue('cart_id',$cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }
}
