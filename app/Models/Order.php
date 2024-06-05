<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'store_id',
        'payment_method',
        'status',
        'number',
        'payment_status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'name' => 'Guest Customer'
        ]);
    }
    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function products(){
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
        ->using(OrderItem::class)
        ->withPivot(['product_name', 'product_price', 'quantity', 'options']);
    }
    public function addresses(){
        return $this->hasMany(OrderAddress::class, 'order_id', 'id');
    }

    public function billingAddress(){
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
        ->where('type', 'shipping');
    }
    public function shippingAddress(){
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
        ->where('type', 'billing');
    }

    public function detail(){
        return $this->hasOne(OrderItem::class, 'order_id');
    }

    protected static function booted()
    {
        static::creating(function(Order $order){
            $order->number= self::getNextOrdderNumber();
        });
    }

    protected static function getNextOrdderNumber(){
        $year= Carbon::now()->year();
        $number= Order::whereYear('created_at', $year)->max('number');
        if($number){
            return $number + 1 ;
        }
        return $year . '0001';
    }
}

