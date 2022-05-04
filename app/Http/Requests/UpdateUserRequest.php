<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'fecha_nacimiento' => 'required|date',
            'ciclo_id' => 'required',
            'dni' => 'required|unique:users,dni,'.$this->user_id,
            'nacionalidad' => 'required',
            'telefono' => 'required',
            'localidad' => 'required',
            'direccion' => 'required',
            'cp' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'La dirección de correo es obligatoria.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'El formato de la fecha de nacimiento no es correcto.',
            'ciclo_id.required'  => 'El ciclo es obligatorio',
            'dni.required' => 'El DNI/NIE es obligatorio',
            'nacionalidad.required'  => 'La nacionalidad es obligatoria',
            'telefono.required'  =>  'El telefono es obligatorio',
            'localidad.required' =>  'La localidad es obligatoria',
            'direccion.required' =>  'La dirección es obligatoria',
            'cp.required' => 'El codigo postal es obligatorio',
            'dni.unique' => 'Ese DNI ya esta en uso',
            'email.unique' => 'Esa dirección de correo ya está en uso'
        ];
    }

    public function updateUser()
    {

        $user = User::findOrFail($this->user_id);
        $user->fill([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'ciclo_id' => $this->ciclo_id,
            'dni' => $this->dni,
            'nacionalidad' => $this->nacionalidad,
            'telefono' => $this->telefono,
            'localidad' => $this->localidad,
            'direccion' => $this->direccion,
            'cp' => $this->cp,
        ]);


        $user->save();
    }
}
