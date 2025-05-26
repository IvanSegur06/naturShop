<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all();
        return view('product.index', compact('productos'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|string',
        ]);

        Product::create($validated);

        return redirect()->route('dashboard')->with('success', 'Producto creado correctamente.');
    }

    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect('/')->with('success', 'Producto eliminado correctamente.');
}


public function shop(Request $request)
{
    $query = Product::with('categories');

    // Filtro por favoritos
    if ($request->filter === 'favorites' && auth()->check()) {
        $query->whereHas('favoritedBy', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }

    // Filtro por categoría
    if ($request->filled('category')) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->where('category.idCategory', $request->category);
        });
    }

    // Filtro por búsqueda
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $productos = $query->get();
    $categorias = Category::all();

    return view('product.index', compact('productos', 'categorias'));
}


}

