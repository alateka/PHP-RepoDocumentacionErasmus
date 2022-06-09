<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="{{asset('img/ue.jpg')}}"/>
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <meta name="theme-color" content="#1885ed">
    <title>@yield('title', 'Erasmus+')</title>
  </head>

  <body>
  <header class="header">
    <div class="container header__container">

        <div class="header__logo mt-2">
          <button class="openbtn d-lg-none mr-2" onclick="openNav()">&#9776;</button>
          <img class="header__img" style="height: 25px; width: 25px" src="{{asset('img/ue.jpg')}}"> <a href="/" class="header__title text-secondary">Erasmus<span class="header__light">+</span></a>
        </div>


    <div class="header__menu">
      <nav id="navbar" class="header__nav collapse">
        <ul class="header__elenco">
          <li class="header__el"><a href="{{url('/')}}" @if(!request()->is('/')) class="header__link"  @endif>Inicio</a></li>
          <li class="header__el"><a href="{{route('info.faq')}}" @if(!request()->routeIs('info.faq')) class="header__link"  @endif>Información</a></li>
          <li class="header__el"><a href="{{route('info.documentos')}}"@if(!request()->routeIs('info.documentos')) class="header__link"  @endif>Documentos</a></li>
          <li class="header__el"><a href="{{route('info.listados')}}"@if(!request()->routeIs('info.listados')) class="header__link"  @endif>Listados</a></li>
          @auth

          <li class="header__el header__el--blue"><a href="{{ url('/home') }}" class="btn btn--white ml-5">Panel de control</a></li>
          <div class="form-inline float-right">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
                <li class="header__el header__el--blue">
                    <a class="btn btn--white" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        this.closest('form').submit();">
            {{ __('Cerrar Sesión') }}
                    </a>
                </li>
            </form>
            </div>
          @else
          <li class="header__el header__el--blue"><a href="{{ route('login') }}" @if(!request()->routeIs('login')) class="btn btn--white ml-5" @else class="btn btn--active ml-5"  @endif>Iniciar sesión</a></li>
          <li class="header__el header__el--blue"><a href="{{ route('register') }}" @if(!request()->routeIs('register')) class="btn btn--white" @else class="btn btn--active"  @endif>Registrarse</a></li>
          @endauth
        </ul>
      </nav>
    </div>
      </div>
  </header>
  <hr>

  <div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="{{url('/')}}">Inicio</a>
    <a href="{{route('info.faq')}}">Información</a>
    <a href="{{route('info.documentos')}}">Documentación</a>
    <a href="{{route('info.listados')}}">Listados</a>
    <?php $user = Auth::user();?>
    @if($user)
    <a href="{{route('home')}}">Volver al panel de control</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-jet-dropdown-link href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                        this.closest('form').submit();">
            {{ __('Cerrar Sesión') }}
        </x-jet-dropdown-link>
    </form>
    @else
    <a href="{{ route('login') }}"class="text-light ">Iniciar sesión</a>
    <a href="{{ route('register') }}"class="text-light">Registrarse</a>
    @endif
</div>

  @yield('content')

  <footer class="footer @yield('class-footer')">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-xs-6">
         <img class="footer__img" style="width: 30px" src="{{asset('img/ue.jpg')}}"> <h1 class="footer__title">Erasmus<span class="footer__light">+</span></h1></div>
        <div class="col-md-10 col-xs-6">
          <div class="footer__social">
            <p class="text-light">Copyright 2021 | Antonio Cantos & José Miguel López</p>
            <p class="text-light">Integración API & APP | Alberto Pérez Fructuoso</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  @yield('js')
    <script>
        /* Set the width of the sidebar to 250px (show it) */
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        /* Set the width of the sidebar to 0 (hide it) */
        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
  </body>
