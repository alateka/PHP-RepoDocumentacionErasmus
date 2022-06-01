<?php

namespace App\Http\Requests;

use App\Models\Solicitud;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateSolicitudRequest extends FormRequest
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
            'cursos' => 'boolean',
            'baremo' => '',
            'expediente_academico' => 'numeric|between:0,3',
            'conocimientos_linguisticos' => 'numeric|between:0,3',
            'evaluacion_docente' => 'numeric|between:0,4',
        ];

    }

    public function messages()
    {
        return [
            'expediente_academico.numeric' => 'La calificación del expediente académico debe ser un número entero.',
            'conocimientos_linguisticos.numeric' => 'La calificación de los conocimientos lingüísticos debe ser de tipo númerico.',
            'evaluacion_docente.numeric' => 'La calificación de la evaluación docente debe ser un número entero.',
            'expediente_academico.between' => 'La calificación del expediente académico debe ser un número entre 0 y 3.',
            'conocimientos_linguisticos.between' => 'La calificación de los conocimientos lingüísticos debe ser un número entre 0 y 3.',
            'evaluacion_docente.between' => 'La calificación de la evaluación docente debe ser un número entre 0 y 4.',
            'carta.boolean' => 'El valor introducido para el campo Carta no es válido',
            'cv.boolean' => 'El valor introducido para el campo CV no es válido',
            'beca.boolean' => 'El valor introducido para el campo Beca no es válido',
            'cursos.boolean' => 'El valor introducido para el campo Curso no es válido',1

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

    public function updateSolicitud(Solicitud $solicitud){

        $solicitud->fill([
            'empresa' => $this->empresa,
            'carta' => $this->carta ?? 0,
            'beca' => $this->beca ?? 0,
            'cursos' => $this->cursos ?? 0,
            'expediente_academico'=> $this->expediente_academico ?? 0,
            'conocimientos_linguisticos' => $this->conocimientos_linguisticos ?? 0,
            'evaluacion_docente' => $this->evaluacion_docente ?? 0,
            'cv' => $this->cv ?? 0,
            'recien_titulado' => $this->recien_titulado ?? 0,
            'baremo' => $this->computeBaremo(),
        ]);

        $solicitud->save();
    }

    public function updateSolicitudByUser(){

        $solicitud = Solicitud::findOrFail($this->solicitud_id);

        $solicitud->fill([
            'empresa' => $this->empresa,
            'carta' => $this->carta ?? 0,
            'beca' => $this->beca ?? 0,
            'cursos' => $this->cursos ?? 0,
            'expediente_academico'=> $this->expediente_academico ?? 0,
            'conocimientos_linguisticos' => $this->conocimientos_linguisticos ?? 0,
            'evaluacion_docente' => $this->evaluacion_docente ?? 0,
            'cv' => $this->cv ?? 0,
            'recien_titulado' => $this->recien_titulado ?? 0,
            'baremo' => $this->computeBaremo(),
        ]);

        $solicitud->save();

        $user = User::findOrFail($this->user_id);

        DB::table('idioma_user')
            ->where('user_id', $this->user_id)
            ->delete();

        if($this->idiomas){

            $sync_data = [];

            for($i = 0; $i<count($this->idiomas); $i++){
                $sync_data[$this->idiomas[$i]] = ['nivel' => $this->nivel[$i]];
            }
            $user->idiomas()->attach($sync_data);
        }



    }

}
