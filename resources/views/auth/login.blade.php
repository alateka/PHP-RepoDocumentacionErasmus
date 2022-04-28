@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('title', 'Iniciar sesión')

@section('content')

 <div class="row justify-content-center mt-5">
    <a href="/">
        <img style="width: 200px; heigth: 100px" src="{{asset('img/erasmuslogo.png')}}" alt=""> 
     </a>
 </div>

<div class="login-box mt-5">
    <form method="POST" id="form" action="{{ route('login') }}">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger mt-3 p-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
      <div class="user-box">
        <input name="email" :value="old('email')" required type="text">
        <label>Email</label>
      </div>
      <div class="user-box">
        <input  type="password" name="password" required>
        <label>Contraseña</label>
      </div>
      <div class="mb-3">
        <a class="text-white" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
      </div>
      <div class="user-box mb-3">
        <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
        <input type="checkbox" name="remember" class="form-check-input mt-3" id="exampleCheck1">
      </div>
      <div class="row justify-content-center mt-5">
        <a href="javascript:{}" id="button" onclick="document.getElementById('form').submit(); return false;">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Iniciar sesión
          </a>
      </div>
      
    </form>
</div>
@endsection

@section('class-footer', 'fixed-bottom')

@section('js')


@endsection