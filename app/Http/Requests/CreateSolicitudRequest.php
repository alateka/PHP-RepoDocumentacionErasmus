<?php

namespace App\Http\Requests;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateSolicitudRequest extends FormRequest
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
            'empresa' => '',
            'carta' => 'boolean',
            'cv' => 'boolean',
            'beca' => 'boolean',
            'idiomas' => '',
            'nivel' => '',
            'cursos' => 'boolean',
            'baremo' => '',
        ];
    }

    public function messages()
    {
        return [
            'carta.boolean' => 'El valor introducido para el campo Carta no es válido',
            'cv.boolean' => 'El valor introducido para el campo CV no es válido',
            'beca.boolean' => 'El valor introducido para el campo Beca no es válido',
            'cursos.boolean' => 'El valor introducido para el campo Curso no es válido',
        ];
    }

    public function computeBaremo(){

        $baremo = 0;

        if($this->empresa){
            $baremo +=2;
        }

        if($this->cv){
            $baremo ++;
        }

        if($this->carta){
            $baremo ++;
        }

        if($this->cursos){
            $baremo ++;
        }

        if($this->expediente_academico){
            $baremo += $this->expediente_academico;
        }

        if($this->conocimientos_linguisticos){
            $baremo += $this->conocimientos_linguisticos;
        }

        if($this->evaluacion_docente){
            $baremo += $this->evaluacion_docente;
        }

        return $baremo;
    }

    public function createSolicitud(){

        Solicitud::create([
            'user_id' => $this->user_id,
            'empresa' => $this->empresa,
            'carta' => $this->carta,
            'cv' => $this->cv,
            'beca' => $this->beca,
            'cursos' => $this->cursos,
            'recien_titulado' => $this->recien_titulado,
            'baremo' => $this->computeBaremo(),
        ]);

        $user = User::where('id', $this->user_id)->firstOrFail();

        if($this->idiomas){

            $sync_data = [];

            for($i = 0; $i<count($this->idiomas); $i++){
                $sync_data[$this->idiomas[$i]] = ['nivel' => $this->nivel[$i]];
            }
            $user->idiomas()->attach($sync_data);
        }

    }
}
