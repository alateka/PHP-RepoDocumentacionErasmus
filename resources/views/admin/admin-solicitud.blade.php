@extends('adminlte::page')

@section('title', 'Validación de usuarios')

@section('plugins.Select2', true)

@section('content_header')
    <h3 class="text-center" style="font-size: 3em; font-weight: 700">Edición de solicitud</h3>
@stop

@section('content')
<div class="row m-5 justify-content-center">

    <form style="width: 60%" class="col-5 card p-5 m-5" method="POST" action="{{route('solicitud.update', $user->solicitud->id)}}">
        <input type="hidden" name="user_id" value="<?=$user->id?>">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger mt-3 p-3">
                <h2 style="font-weight: 600" class="mb-3">Se registraron los siguientes errores:</h2>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 style="font-size: 2em; font-weight: 700;" class="text-center mb-5">Datos personales</h2>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="full_name">Nombre y Apellidos</label>
                <input type="text" class="form-control" name="full_name" value="<?= $user->name?> <?= $user->last_name?>" disabled>
            </div>
            <div class="form-group col-6">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" value="<?= $user->email ?>" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                <label for="f_nac">Fecha de nacimiento</label>
                <input type="text" class="form-control" name="f_nac" value="<?= $user->fecha_nacimiento?>" disabled>
            </div>
            <div class="form-group col-4">
                <label for="dni">DNI/NIE</label>
                <input type="text" class="form-control" name="dni" value="<?= $user->dni?>" disabled>
            </div>
            <div class="form-group col-4">
                <label for="nacionalidad">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad" value="<?= $user->nacionalidad?>" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                <label for="localidad">Localidad</label>
                <input type="text" disabled class="form-control" value="<?= $user->localidad?>">
            </div>
            <div class="form-group col-8">
                <label>Domicilio</label>
                <input type="text" disabled class="form-control" value="<?= $user->direccion?>">
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-6">
                <label for="phone">Telefono de contacto</label>
                <input type="tel" disabled class="form-control" value="<?= $user->telefono?>">
            </div>
            <div class="form-group col-6">
                <label for="codigo_postal">Código postal</label>
                <input type="text" disabled class="form-control" value="<?= $user->cp?>">
            </div>
        </div>

        <hr class="mb-3 mt-4">
        
        <h2 style="font-size: 2em; font-weight: 700;" class="text-center mt-4 mb-4">Datos académicos</h2>
        <div class="form-row">
            <div class="form-group col-4">
                <label for="grado">Grado</label>
                <input type="text" class="form-control" name="grado" value="<?= $user->ciclo->grado?>" disabled>
            </div>
            <div class="form-group col-8">
                <label for="ciclo">Ciclo</label>
                <input type="text" class="form-control" name="ciclo" value="<?= $user->ciclo->nombre?>" disabled>
            </div>
        </div>

        <hr class="mt-4">

        <h2 style="font-size: 2em; font-weight: 700;" class="text-center mt-5 mb-3">Conocimientos lingüísticos</h2>
        @if(count($idiomas))
        <ul class="list-group">
            @foreach($idiomas as $idioma)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?=$idioma->name?>
                <span class="badge badge-primary badge-pill"><?=$idioma->nivel?></span>
            </li>
            @endforeach
          </ul>
        @else 
        <p class="text-center text-danger underline">El alumno no presenta ningún idioma</p>
        @endif

        <hr class=" mt-4">
       
        <h2 style="font-size: 2em; font-weight: 700;" class="text-center m-5">Información adicional</h2>
        
        <div class="form-row">
            <div class="form-group col-12">
                <label for="empresa">Nombre de la empresa</label>
                <input type="text" name="empresa" class="form-control" value="<?=$user->solicitud->empresa?>">
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="form-check form-check-inline">
                <input class="form-check-input" @if($user->solicitud->beca) checked @endif type="checkbox" name="beca" value="1">
                <label class="form-check-label" for="inlineCheckbox1">Beca</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" @if($user->solicitud->carta) checked @endif type="checkbox" name="carta" value="1">
                <label class="form-check-label"  for="inlineCheckbox2">Carta</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" @if($user->solicitud->cv) checked @endif type="checkbox" name="cv" value="1">
                <label class="form-check-label"  for="inlineCheckbox1">CV</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" @if($user->solicitud->cursos) checked @endif type="checkbox" name="cursos" value="1">
                <label class="form-check-label"  for="inlineCheckbox2">Cursos de formación</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" @if($user->solicitud->recien_titulado) checked @endif type="checkbox" name="recien_titulado" value="1">
                <label class="form-check-label" for="inlineCheckbox3">Recien titulado</label>
              </div>
        </div>

        <div class="form-row mt-4">
            <div class="form-group col-12">
                <label for="conocimientos_linguisticos">Conocimientos lingüísticos (MAX 3,00 puntos)</label>
                <input type="number" step="0.01" name="conocimientos_linguisticos" class="form-control" value="<?=$user->solicitud->conocimientos_linguisticos?>">
            </div>
            
        </div>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="expediente_academico">Expediente académico (MAX 3,00 puntos)</label>
                <input type="number" step="0.01" name="expediente_academico" class="form-control"  value="<?=$user->solicitud->expediente_academico?>">
            </div>
            
        </div>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="evaluacion_docente">Evaluación del equipo docente (MAX 4,00 puntos)</label>
                <input type="number" step="0.01" name="evaluacion_docente" class="form-control" value="<?=$user->solicitud->evaluacion_docente?>">
                <input type="hidden" name="baremo" class="form-control">
            </div>        
        </div>

        <h1 style="font-weight: 700; font-size: 1.8em" class="mt-3 text-center text-danger">Baremo provisional: <?=$user->solicitud->baremo ?? '0'?> puntos.</h1>
    
        
        
        <button type="submit"  class="align-self-center w-50 mt-5 btn btn-primary">Actualizar solicitud</button>
    </form>

    <div class="col-5 card p-5 m-5">
        <h2 class="text-center mb-5" style="font-size: 2.5em; font-weight: 700">Documentos</h2>
        @if(count($user->solicitud->documentos)) 
        <table>
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="col-8 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nombre del documento
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Descargar
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider float-right">
                Eliminar
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">   
            @foreach($user->solicitud->documentos as $d)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $d->documento ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a class="focus:outline-none text-white text-sm py-2 px-3 border-b-4 border-blue-600 rounded-md bg-blue-500 hover:bg-blue-400" href="{{ route('documents.download', $d->id) }}"><i class="fas fa-file-download"></i></a>
                </td>
                <td class="form-inline mt-3 float-right mr-4">
                <form class="form-delete mr-1" action="{{ route('documents.delete', $d->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                <button class="deleteUser focus:outline-none text-white text-sm py-2 px-3 border-b-4 border-red-600 rounded-md bg-red-500 hover:bg-red-400"><i class="far fa-trash-alt"></i></button>
                </form>
                </td>
            </tr>
            @endforeach 
        </tbody> 
        </table> 
        @else
            <h1 class="text-center text-danger underline">El usuario no ha subido ningún archivo.</h1>
        @endif
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}"> 
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body{
            overflow-y: scroll;
            overflow-x: hidden;
            }
    </style>
@stop


