@extends('layouts.layout')

@section('title', 'Registro de usuario')

@section('content')

<style>
    form {
    background: rgba(31, 68, 103, .6);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
  }
</style>

<?php
use App\Models\Ciclo;

$ciclos = Ciclo::orderBy('nombre')->get();

?>

<div class="row justify-content-center mt-5">
    <a href="/">
        <img style="width: 200px; heigth: 100px" src="{{asset('img/erasmuslogo.png')}}" alt=""> 
     </a>
 </div>
<x-guest-layout>

 
<div class="row justify-content-center mb-5">
    <form class="border rounded mt-5 p-5" method="POST" action="{{ route('register') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <h2 style="font-weight: 800" class="mb-3">Se registraron los siguientes errores:</h2>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <x-jet-label for="name" value="{{ __('Nombre') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ej: Pepe" />
            </div>
            <div class="col-sm-12 col-md-4">
                <x-jet-label for="last_name" value="{{ __('Apellidos') }}" />
                <x-jet-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" placeholder="Ej: Pérez" />
            </div>
            <div class="col-sm-12 col-md-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Ej: example@mail.es"/>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12 col-md-4">
                <x-jet-label for="fecha_nacimiento" value="{{ __('Fecha de Nacimiento') }}" />
                <x-jet-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" :value="old('fecha_nacimiento')" required  />
            </div>
            <div class="col-sm-12 col-md-4">
                <x-jet-label for="dni" value="{{ __('DNI/NIE') }}" />
                <x-jet-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" required placeholder="Ej: 12345678A" />
            </div>
            <div class="col-sm-12 col-md-4">
                <x-jet-label for="telefono" value="{{ __('Teléfono') }}" />
                <x-jet-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required placeholder="Ej: 666666666" />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12 col-md-3">
                <x-jet-label for="localidad" value="{{ __('Localidad') }}" />
                <x-jet-input id="localidad" class="block mt-1 w-full" type="text" name="localidad" :value="old('localidad')" required placeholder="Ej: Murcia"/>
            </div>
            <div class="col-sm-12 col-md-3">
                <x-jet-label for="cp" value="{{ __('Código Postal') }}" />
                <x-jet-input id="cp" class="block mt-1 w-full" type="text" name="cp" :value="old('cp')" required  placeholder="Ej: 30009"/>
            </div>
            <div class="col-sm-12 col-md-6">
                <x-jet-label for="direccion" value="{{ __('Dirección') }}" />
                <x-jet-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" required placeholder="Ej: C/Falsa 123" />
            </div>
        </div>

        <div class="row mt-4">
            
            <div class="col-sm-12 col-md-3 form-group">
                <x-jet-label for="nacionalidad" value="{{ __('Nacionalidad') }}" />
                <select class="form-control rounded mt-1" required style="width: 100%" name="nacionalidad" id="nacionalidad">
                    <option disabled selected>Nacionalidad</option>
                    <option value="Alemania" {{("Alemania" == old('nacionalidad')) ? 'selected' : ''}}>Alemania</option>
                    <option value="Austria"  {{("Austria" == old('nacionalidad')) ? 'selected' : ''}}>Austria</option>
                    <option value="Bélgica"  {{("Bélgica" == old('nacionalidad')) ? 'selected' : ''}}>Bélgica</option>
                    <option value="Bulgaria" {{("Bulgaria" == old('nacionalidad')) ? 'selected' : ''}}>Bulgaria</option>
                    <option value="Croacia" {{("Croacia" == old('nacionalidad')) ? 'selected' : ''}}>Croacia</option>
                    <option value="Dinamarca" {{("Dinamarca" == old('nacionalidad')) ? 'selected' : ''}} >Dinamarca</option>
                    <option value="Eslovaquia" {{("Eslovaquia" == old('nacionalidad')) ? 'selected' : ''}}>Eslovaquia</option>
                    <option value="Eslovenia" {{("Eslovenia" == old('nacionalidad')) ? 'selected' : ''}}>Eslovenia</option>
                    <option value="España" {{("España" == old('nacionalidad')) ? 'selected' : ''}} >España</option>
                    <option value="Estonia"  {{("Estonia" == old('nacionalidad')) ? 'selected' : ''}}>Estonia</option>
                    <option value="Finlandia" {{("Finlandia" == old('nacionalidad')) ? 'selected' : ''}} >Finlandia</option>
                    <option value="Francia" {{("Francia" == old('nacionalidad')) ? 'selected' : ''}}>Francia</option>
                    <option value="Grecia" {{("Grecia" == old('nacionalidad')) ? 'selected' : ''}} >Grecia</option>
                    <option value="Hungría" {{("Hungría" == old('nacionalidad')) ? 'selected' : ''}}>Hungría</option>
                    <option value="Irlanda" {{("Irlanda" == old('nacionalidad')) ? 'selected' : ''}}>Irlanda</option>
                    <option value="Italia" {{("Italia" == old('nacionalidad')) ? 'selected' : ''}}>Italia</option>
                    <option value="Letonia" {{("Letonia" == old('nacionalidad')) ? 'selected' : ''}}>Letonia</option>
                    <option value="Lituania" {{("Lituania" == old('nacionalidad')) ? 'selected' : ''}}>Lituania</option>
                    <option value="Luxemburgo" {{("Luxemburgo" == old('nacionalidad')) ? 'selected' : ''}}>Luxemburgo</option>
                    <option value="Malta" {{("Malta" == old('nacionalidad')) ? 'selected' : ''}}>Malta</option>
                    <option value="Países Bajos" {{("Países Bajos" == old('nacionalidad')) ? 'selected' : ''}}>Países Bajos</option>
                    <option value="Polonia" {{("Polonia" == old('nacionalidad')) ? 'selected' : ''}}>Polonia</option>
                    <option value="Portugal" {{("Portugal" == old('nacionalidad')) ? 'selected' : ''}}>Portugal</option>
                    <option value="Rumanía" {{("Rumanía" == old('nacionalidad')) ? 'selected' : ''}}>Rumanía</option>
                    <option value="Suecia" {{("Suecia" == old('nacionalidad')) ? 'selected' : ''}}>Suecia</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
                <x-jet-label for="ciclo" value="{{ __('Ciclo Formativo') }}" />
                <select class="form-control rounded mt-1" required style="width: 100%" name="ciclo" id="ciclo">
                    <option disabled selected>Seleccione un Ciclo Formativo</option>
                   @foreach ($ciclos as $c)
                    <option value="<?=$c->id?>" {{($c->id == old('ciclo')) ? 'selected' : ''}}><?=$c->nombre?></option>
                   @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-3 form-group">
                <x-jet-label for="year" value="{{ __('Curso') }}" />
                <select class="form-control rounded mt-1" required style="width: 100%" name="year" id="year">
                    <option disabled selected value="">Curso</option>
                    <option value="2021/2022" {{("2021/2022" == old('year')) ? 'selected' : ''}}>2021/2022</option>
                    <option value="2020/2021" {{("2020/2021" == old('year')) ? 'selected' : ''}}>2020/2021</option>
                    <option value="2019/2020" {{("2019/2020" == old('year')) ? 'selected' : ''}}>2019/2020</option>
                    <option value="2018/2019" {{("2018/2019" == old('year')) ? 'selected' : ''}}>2018/2019</option>
                </select>
            </div>
        </div>
        <div class="row mt-4 mb-3">
            <div class="col-sm-12 col-md-6">
                <x-jet-label for="password" value="{{ __('Contraseña*') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
            <div class="col-sm-12 col-md-6">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña*') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>
        <span style="color: rgb(0, 0, 0); font-size: .8em;">*La contraseña debe contener al menos 8 caracteres.</span><br>
        <span style="color: rgb(0, 0, 0); font-size: .8em">Todos los campos son obligatorios.</span>
        <div class="flex items-center justify-end mt-4">
            
            <x-jet-button class="ml-4">
                {{ __('Registrar') }}
            </x-jet-button>
        </div>
    </form>
</div>
        
  
</x-guest-layout>

@endsection

@section('class-footer', 'd-none')
