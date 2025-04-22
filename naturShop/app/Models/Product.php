<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'description'];

    public function shoppingCart()
    {
        return $this->belongsToMany(ShoppingCart::class)->withPivot('nProduct', 'price');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('nProduct', 'price');
    }
}
