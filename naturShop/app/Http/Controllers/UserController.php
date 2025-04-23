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
}
