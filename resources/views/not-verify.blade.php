@extends('layouts.layout')

@section('content')

<div style="margin-top: 5%" class="row justify-content-center">
    <img style="height: 200px; width:200px" src="{{asset('img/check.png')}}" alt="">
</div>
<h1 style="font-weight: 900; font-size: 4em" class="text-center mt-3">¡Gracias por registrarse!</h1>
<h4 class="text-center mt-3">El registro se ha realizado satisfactoriamente.</h4>
<h4 class="text-center mt-3">Podrá acceder a su panel de control cuando un usuario administrador verifique su cuenta.</h4>
@endsection

@section('class-footer', 'fixed-bottom')

