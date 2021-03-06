<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css')}}" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css')}}">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
        <!-- Bootstrap NavBar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-info">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="https://www.ucn.cl/wp-content/themes/ucn-central/img/logofooter.png" width="120" height="30" class="d-inline-block align-top" alt="">
            <span class="menu">Sistema de bitacora <b>UCN</b></span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    
                    <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio <span class="sr-only">(current)</span></a>
                </li>
                
                
                <!-- Menu usado para pantallas de celular resolucion  -->
                <li class="nav-item dropdown d-sm-block d-md-none">
                    @guest
                        <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                    @else
                        <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                        <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    @endguest
                    <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                        @guest
                            <a class="dropdown-item" href="{{ route('login') }}">Ingresar</a>
                            <a class="dropdown-item" href="#">Contactar a Soporte</a>
                        @else
                            @foreach(Auth::user()->rols as $rols)
                                @if ($rols->rol == 'ADMINISTRADOR' || $rols->rol == 'ENCARGADO DE TITULACION')
                                    <a class="dropdown-item" href="/usuario">Gestor de Usuarios</a>
                                    <a class="dropdown-item" href="{{ route('bitacora.index') }}">Gestor de Bitacoras</a>
                                    <a class="dropdown-item" href="#">Gestor de Avances</a>
                                    @break
                                @endif

                            @endforeach 

                            
                            <a class="dropdown-item" href="#">Mensajes</a>
                        @endguest
                    </div>
                </li><!-- Smaller devices menu END -->
            </ul>
        </div>
    </nav><!-- NavBar END -->
    <div class="row" id="body-row">
        <!-- Sidebar -->
        <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
            <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
            <!-- Bootstrap List Group -->
            <ul class="list-group">
                @guest
                    <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                        <small>MENU PRINCIPAL</small>
                    </li>
                    <a href="{{ route('login') }}" class="bg-dark list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fas fa-user fa-fw mr-3"></span>
                            <span class="menu-collapsed">Ingresar</span>
                        </div>
                    </a>
                    <a href="" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-question fa-fw mr-3"></span>
                        <span class="menu-collapsed">Contacta a Soporte</span>
                    </div>
                </a>

                <!-- Separator without title -->
                <li class="list-group-item sidebar-separator menu-collapsed"></li>
                <!-- /END Separator -->
                    

                @else

                    @foreach(Auth::user()->rols as $rols)
                        @if ($rols->rol == 'ADMINISTRADOR' || $rols->rol == 'ENCARGADO DE TITULACION')
                    
                    <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                        <small>MENU PRINCIPAL</small>
                    </li>
                    
                    <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fas fa-exclamation-circle fa-fw mr-3"></span>
                        <span class="menu-collapsed">Panel de Cont</span>
                        <span class=" ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu1' class="collapse sidebar-submenu">
                    <a href="/usuario" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Gestor de Usuarios</span>
                    </a>
                    <a href="{{ route('bitacora.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Gestor de Bitacoras</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Gestor de Avances</span>
                    </a>
                </div>

                @break
                @endif

            @endforeach 
                
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <small>Alertas</small>
                </li>

                <a href="#" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fas fa-bell fa-fw mr-3"></span>
                        <span class="menu-collapsed">Mensajes <span class="badge badge-pill badge-primary ml-2">0</span></span>
                    </div>
                </a>

                <!-- Separator without title -->
                <li class="list-group-item sidebar-separator menu-collapsed"></li>
                <!-- /END Separator -->

                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="sr-only">(current)</span>
                        <span class="fas fa-power-off fa-fw mr-3"></span>
                        <span class="menu-collapsed">Salir</span>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>


                @endguest
                
                
                <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                        <span id="collapse-text" class="menu-collapsed">Collapse</span>
                    </div>
                </a>
                <!-- Logo -->

            </ul><!-- List Group END-->
        </div><!-- sidebar-container END -->
        <!-- MAIN -->
         
        <div class="col">
            @yield('content')
        </div><!-- Main Col END -->
    </div><!-- body-row END -->
    
    

    <!-- Scripts -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
</body>
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright
    <a href=""> </a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</html>
