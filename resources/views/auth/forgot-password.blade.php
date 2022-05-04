@extends('layouts.layout')

@section('title', 'Recuperar contraseña')

@section('content')

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
               <img class="w-26 h-16" src="{{asset('img/erasmuslogo.png')}}" alt=""> 
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Introduce el e-mail asociado a tu cuenta y te enviaremos un enlace para restaurar tu contraseña.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Recuperar contraseña') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

@endsection

@section('class-footer', 'd-none')
