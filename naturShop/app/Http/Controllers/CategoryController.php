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


   public function store(Request $request)
{
    $request->validate([
        'nameCategory' => 'required|string|max:255',
    ]);

    Category::create([
        'nameCategory' => $request->nameCategory,
    ]);

    return redirect()->back()->with('status', 'Categoría creada correctamente.');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->back()->with('status', 'Categoría eliminada.');
}

}
