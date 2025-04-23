<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'No autorizado');
        }

        $address = $user->address;

        return view('auth.dashboard', compact('address'));
    }

    public function create()
{
    return view('address.create');
}

public function store(Request $request)
{
    $request->validate([
        'street' => 'required',
        'number' => 'required|integer',
        'city' => 'required',
        'country' => 'required',
        'postcode' => 'required',
    ]);

    Address::create([
        ...$request->all(),
        'idUser' => auth()->id(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Dirección creada correctamente.');
}

public function edit(Address $address)
{
    return view('address.edit', compact('address'));
}

public function update(Request $request, Address $address)
{
    $address->update($request->all());
    return redirect()->route('dashboard')->with('success', 'Dirección actualizada correctamente.');
}

public function destroy(Address $address)
{
    $address->delete();
    return redirect()->route('dashboard')->with('success', 'Dirección eliminada correctamente.');
}

}
