<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;

use App\Models\Product;

class ShoppingCartController extends Controller
{
    public function show()
{
    $cart = ShoppingCart::firstOrCreate(
        ['idUser' => Auth::id()],
        ['total' => 0, 'amount' => 0]
    );

    return view('cart.show', compact('cart'));
}



public function index()
{
    // Obtener el carrito de compras del usuario autenticado
    $cart = ShoppingCart::where('idUser', auth()->id())->first();

    // Obtener los productos en el carrito, si existen
    $productos = $cart ? $cart->products : [];

    return view('cart.index', compact('cart', 'productos'));
}





public function addProductToCart(Request $request, $productId)
{
    // Obtener el carrito de compras del usuario autenticado
    $cart = ShoppingCart::where('idUser', auth()->id())->first();

    // Si el carrito no existe, crear uno
    if (!$cart) {
        $cart = ShoppingCart::create(['idUser' => auth()->id()]);
    }

    // Obtener el producto
    $product = Product::findOrFail($productId);

    // Verificar si el producto ya está en el carrito
    $existingProduct = $cart->products()->where('product.id', $productId)->first();

    if ($existingProduct) {
        // Si el producto ya está en el carrito, actualizar la cantidad
        $cart->products()->updateExistingPivot($productId, [
            'nProduct' => $existingProduct->pivot->nProduct + 1,
            'price' => $product->price,
        ]);
    } else {
        // Si el producto no está en el carrito, agregarlo
        $cart->products()->attach($productId, [
            'nProduct' => 1,
            'price' => $product->price,
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito');
}

public function removeProduct($productId)
{
    $cart = ShoppingCart::where('idUser', auth()->id())->first();
    
    if ($cart) {
        // Eliminar el producto del carrito
        $cart->products()->detach($productId);
        return redirect()->route('cart.index')->with('status', 'Producto eliminado del carrito.');
    }

    return redirect()->route('cart.index')->with('error', 'Error al eliminar el producto.');
}

public function decreaseProductQuantity($productId)
{
    $cart = ShoppingCart::where('idUser', auth()->id())->first();

    if (!$cart) return redirect()->route('cart.index');

    $product = $cart->products()->where('product.id', $productId)->first();

    if ($product) {
        $newQty = $product->pivot->nProduct - 1;

        if ($newQty <= 0) {
            // Eliminar del carrito si la cantidad llega a 0
            $cart->products()->detach($productId);
        } else {
            // Actualizar cantidad
            $cart->products()->updateExistingPivot($productId, [
                'nProduct' => $newQty,
                'price' => $product->pivot->price,
            ]);
        }
    }

    return redirect()->route('cart.index')->with('status', 'Cantidad actualizada');
}

public function applyDiscount(Request $request)
{
    $request->validate([
        'discount_code' => 'required|string',
    ]);

    $discount = Discount::where('code', $request->discount_code)->first();

    if (!$discount) {
        return redirect()->back()->with('error', 'Código de descuento no válido.');
    }

    $cart = ShoppingCart::where('idUser', auth()->id())->first();

    if (!$cart) {
        return redirect()->back()->with('error', 'Carrito no encontrado.');
    }

    $cart->idDiscount = $discount->id;
    $cart->save();

    return redirect()->back()->with('success', 'Descuento aplicado correctamente.');
}


}
