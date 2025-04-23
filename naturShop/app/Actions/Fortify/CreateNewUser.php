<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            's_name' => ['nullable', 'string', 'max:255'], // Campo personalizado
            'phone' => ['nullable', 'string', 'max:20'],   // Campo personalizado
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            's_name' => $input['s_name'] ?? null, // Añadido
            'phone' => $input['phone'] ?? null,   // Añadido
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => 'client', // Valor por defecto
        ]);
    }
}
