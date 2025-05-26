<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function assign(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:category,idCategory',
        ]);

        // Asocia la categoría al producto (evita duplicados)
        $product->categories()->syncWithoutDetaching([$request->category_id]);

        return redirect()->back()->with('success', 'Categoría asignada correctamente.');
    }


   

}
