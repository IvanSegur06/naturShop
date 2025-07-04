<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    
    protected $table = 'order_has_product';

    protected $fillable = ['idOrder', 'idProduct', 'nProduct', 'price'];

}