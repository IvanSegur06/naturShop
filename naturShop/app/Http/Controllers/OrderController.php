<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createOrder()
    {

        
        echo 'MU WENA ';
        // Obtener el carrito de compras del usuario autenticado
        $cart = ShoppingCart::where('idUser', auth()->id())->first();

        if (!$cart || $cart->products->isEmpty()) {

            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            // Crear la orden
            $order = Order::create([
                'idUser' => auth()->id(),
                'date' => now()->toDateString(),
                'status' => 'in progress', // Estado inicial
            ]);
           
            // Transferir los productos del carrito a la orden
            foreach ($cart->products as $product) {

                
                $order->products()->attach($product->id, [
                    'nProduct' => $product->pivot->nProduct,
                    'price' => $product->pivot->price,
                ]);

               

            }

            // Vaciar carrito
            $cart->products()->detach();

            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Pedido realizado con éxito.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Error al procesar el pedido.');
        }
    }
}
