<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function delete($id)
    {
        $usuario = User::find($id);

        if ($usuario) {
            $usuario->delete();
            return redirect('/')->with('success', 'Usuario eliminado correctamente.');
        } else {
            return redirect('/')->with('error', 'Usuario no encontrado.');
        }
    }

    public function edit($id)
    {
    // Buscar el usuario por ID
    $usuario = User::find($id);
    
    // Si el usuario no existe, redirigir con un mensaje de error
    if (!$usuario) {
        return redirect()->route('dashboard')->with('error', 'Usuario no encontrado.');
    }

    // Pasar los datos del usuario a la vista
    return view('user.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
    // Validar los datos
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        // Puedes añadir más reglas de validación si es necesario
    ]);

    // Buscar el usuario por ID
    $usuario = User::find($id);

    // Si el usuario no existe, redirigir con un mensaje de error
    if (!$usuario) {
        return redirect()->route('dashboard')->with('error', 'Usuario no encontrado.');
    }

    // Actualizar los datos del usuario
    $usuario->name = $request->input('name');
    $usuario->email = $request->input('email');
    // Puedes actualizar más campos si es necesario
    $usuario->save();

    // Redirigir con un mensaje de éxito
    return redirect()->route('dashboard')->with('success', 'Usuario actualizado correctamente.');
    }



    public function showData($id)
    {
        $user = User::find($id); // Obtiene los datos del usuario autenticado
        return view('user.data', compact('user')); // Pasa los datos a la vista
    }




}
