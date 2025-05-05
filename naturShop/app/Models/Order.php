<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['idUser', 'date', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_has_product', 'idOrder', 'idProduct')
                ->withPivot('nProduct', 'price')
                ->withTimestamps();
    }
}
