<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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

}

