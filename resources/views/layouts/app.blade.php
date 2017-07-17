<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{  config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> 



    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    
                   
                                <a class="navbar-brand" href="{{ url('home') }}">
                                {{ config('app.name') }}
                                </a>
                                
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="{{ url('home') }}" role="button" aria-expanded="false">Home</a></li>
                            <li class="dropdown">
                                
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('myquestions') }}">My Questions</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                
            </div>
        </nav>

        @yield('content')
            <div class="footer navbar-default navbar-fixed-bottom">
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="text-muted  text-center "></h5>
                    </div>
                    <div class="col-sm-4">
                        <h5 style="font-family: Verdana" class="text-center">Developed by The <a class ="text-muted" style="text-decoration: none !important" target="_blank" href="http://www.vikarasystems.com/">VIKARA Systems</a></h5>
                    </div>
                    <div class="col-sm-4">
                        <h5 class="text-muted  text-center "></h5>
                    </div>
                </div>
            </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
  <!--  <script src="{{ asset('js/bootstrap.min.js') }}"></script> --> 

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">

        @if( notify()->ready() )

            swal({
                title: "{!! notify()->message() !!}",
                type: "{{ notify()->type() }}",
                @if( notify()->option('timer') )

                    timer:"{{ notify()->option('timer') }}",
                    showConfirmButton:false,                
                @endif
                html:true
            });

        @endif 

    </script>
</body>

</html>
