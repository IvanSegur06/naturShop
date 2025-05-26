<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'idCategory';
    public $timestamps = false;

    protected $fillable = ['nameCategory'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_has_product', 'Category_idCategory', 'Product_idProduct');
    }
}

