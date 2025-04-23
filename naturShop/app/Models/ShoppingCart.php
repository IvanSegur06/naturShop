<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    

    protected $fillable = ['idUser', 'total', 'amount'];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'shopping_cart_has_product', 'idShoppingCart', 'idProduct')
                    ->withPivot('nProduct', 'price')
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
