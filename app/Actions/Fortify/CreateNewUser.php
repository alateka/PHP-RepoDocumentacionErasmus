<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'last_name' => ['required', 'string', 'max:255'],
            'ciclo' => ['required'],
            'fecha_nacimiento' => ['required','date'],
            'dni' => ['size:9', 'unique:users'],
            'year' => ['required'],
            'telefono' => ['required'],
            'localidad' => ['required'],
            'cp' => ['required'],
            'direccion' => ['required'],
            'nacionalidad' => ['required'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'ciclo_id' => $input['ciclo'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'dni' => $input['dni'],
            'year' => $input['year'],
            'telefono' => $input['telefono'],
            'localidad' => $input['localidad'],
            'direccion' => $input['direccion'],
            'cp' => $input['cp'],
            'nacionalidad' => $input['nacionalidad'],
            'password' => Hash::make($input['password']),
            'remember_token' => $input['_token'],
        ]);
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'La dirección de correo es obligatoria.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'ciclo_id.required'  => 'El ciclo es obligatorio',
            'dni.required' => 'El DNI/NIE es obligatorio',
            'nacionalidad.required'  => 'La nacionalidad es obligatoria',
            'telefono.required'  =>  'El telefono es obligatorio',
            'localidad.required' =>  'La localidad es obligatoria',
            'direccion.required' =>  'La dirección es obligatoria',
            'cp.required' => 'El codigo postal es obligatorio',
            'email.unique' => 'Esta direccion de correo ya esta en uso en la plataforma',
            'dni.unique'   => 'El DNI/NIE introducido ya está registrado en la plataforma',
        ];
    }
}
