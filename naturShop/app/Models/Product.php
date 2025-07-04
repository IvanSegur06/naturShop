<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = ['name', 'price', 'stock', 'description'];

    public function shoppingCarts()
    {
        return $this->belongsToMany(ShoppingCart::class, 'shopping_cart_has_product', 'idProduct', 'idShoppingCart')
                    ->withPivot('nProduct', 'price')
                    ->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_has_product', 'idProduct', 'idOrder')
                    ->withPivot('nProduct', 'price')
                    ->withTimestamps();
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite_product', 'product_id', 'user_id')->withTimestamps();
    }

    public function usersWhoFavorited()
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_id', 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_has_product', 'Product_idProduct', 'Category_idCategory');
    }
}
