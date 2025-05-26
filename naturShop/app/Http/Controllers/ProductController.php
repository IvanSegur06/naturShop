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
    // Obtener todos los productos
    $query = Product::query();

    // Filtro por búsqueda
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filtro por favoritos (solo si el usuario está autenticado)
    if ($request->has('filter') && $request->filter == 'favorites' && auth()->check()) {
        $query->whereHas('favoredByUsers', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }

    // Obtener los productos con los filtros aplicados
    $productos = $query->get();
    $categorias = Category::all(); 

    return view('product.index', compact('productos', 'categorias'));
}


}

