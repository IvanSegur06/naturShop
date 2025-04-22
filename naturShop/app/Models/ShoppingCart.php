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
        return $this->belongsToMany(Product::class)->withPivot('nProduct','price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
