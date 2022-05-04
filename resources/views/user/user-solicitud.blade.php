
@livewire('navigation-menu')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('/css/checkbox.css')}}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(auth()->user()->solicitud)
                {{ __('Editar solicitud beca Erasmus+') }}
            @else
                {{ __('Solicitud beca Erasmus+') }}
            @endif
        </h2>
    </x-slot>

    <x-slot name="slot">
        @livewire('user-solicitud')
    </x-slot>


</x-app-layout>



@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop
