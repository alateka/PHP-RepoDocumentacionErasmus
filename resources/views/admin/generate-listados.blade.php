@extends('adminlte::page')

@section('title', 'Generación de listados')


@section('css')
<link rel="stylesheet" href="{{asset('css/listados.css')}}">
@endsection

@section('content_header')
    <h3 class="text-center" style="font-size: 3em; font-weight: 700">Generación de listados</h3>
@stop

@section('content')
   @livewire('generate-listados')
@stop

