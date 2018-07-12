<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  rel="icon" href="{!! asset('imagedefault/icono.ico') !!}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CMS') }}</title>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/resources/sweetalert.css') }}">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'CMS') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('info') }}"> Info</a></li>
                    </ul>



                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">  Iniciar Sesión</a></li>
                            
                        @else
                            <li>
                                <a id="deliveries" href="{{ route('deliveries.index') }}">Entregas</a>
                            </li>
                            <li>
                                <a id="receptions" href="{{ route('receptions.index') }}">Recepciónes</a>
                            </li>
                            <li>
                                <a  id="clients" href="{{ route('clients.index') }}">Clientes</a>
                            </li>
                             <li class="dropdown">

                                <a id="complements" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <!--<span class="glyphicon glyphicon-user"></span>-->
                                    Complementos <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('equipments.index') }}">
                                            Equipos
                                        </a>
                                        <a href="{{ route('reasons.index') }}">
                                            Razones
                                        </a>
                                    </li>
                                </ul>
                                
                            </li>
                            @if(Auth::user()->userType !== 'READONLY')
                                <li>
                                    <a id="empresas" href="{{ route('empresas.edit', 1) }}"> 
                                        Empresa
                                    </a>
                                </li>   
                            @endif

                            @if(Auth::user()->userType == 'ADMINISTRATOR')
                            <li>
                                <a id="users" href="{{ route('manageusers.index') }}">Usuarios </a>
                            </li>
                            @endif

                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    @if(Auth::user()->file)
                                        <img src="{{ Auth::user()->file }}" width="20" height="20" class="img-circle profile_img">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                            
                                    @else
                                        <span class="glyphicon glyphicon-user"></span>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    @endif
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a id="showSetting" href="{{ route('showSetting', Auth::user()->id) }}">Ajustes </a>
                                    </li>


                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                            Cerrar Sesión
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('include_delete')
        
        @if(session('danger'))
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="alert alert-danger">
                            {{ session('danger')}}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(count($errors))
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js')


    <script src="{{ asset('js/resources/sweetalert.js') }}"></script>

    @include('sweet::alert')

    

    <script type="text/javascript">    
        var pathname = window.location.pathname;
        //alert(pathname);
        //alert(pathname);

        if (pathname.indexOf('clients') != -1) {

            $('#clients').css('background','#B5DEF7');
            //alert(pathname);

        } else if (pathname.indexOf('manageusers') != -1)  {

            $('#users').css('background','#B5DEF7');

        } else if (pathname.indexOf('receptions') != -1) {

            $('#receptions').css('background','#B5DEF7');
        
        }else if (pathname.indexOf('deliveries') != -1) {

            $('#deliveries').css('background','#B5DEF7');
        
        } else if (pathname.indexOf('equipments') != -1) {

            $('#complements').css('background','#B5DEF7');
        
        } else if (pathname.indexOf('reasons') != -1) {

            $('#complements').css('background','#B5DEF7');

        } else if (pathname.indexOf('empresas') != -1) {

            $('#empresas').css('background','#B5DEF7');
        }

    </script>



    @yield('scripts')
</body>
</html>
