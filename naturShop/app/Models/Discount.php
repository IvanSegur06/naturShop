<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Discount extends Model
{
    use HasFactory;

     protected $fillable = [
        'code',
        'percentage',
        'description',
    ];



    public function shoppingCarts()
{
    return $this->hasMany(ShoppingCart::class, 'idDiscount');
}

}
