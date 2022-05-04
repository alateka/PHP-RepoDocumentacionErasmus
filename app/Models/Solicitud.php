<?php

namespace App\Models;

use App\Models\Documento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id',
        'empresa',
        'beca',
        'carta',
        'cv',
        'name',
        'nivel',
        'cursos',
        'expediente_academico',
        'conocimientos_linguisticos',
        'evaluacion_docente',
        'baremo'
    ];

    public function documentos(){

        return $this->hasMany(Documento::class);
    }
}
