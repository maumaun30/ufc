<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(Auth::user())
        <title>{{ Auth::user()->company }}</title>
    @else
        <title>{{ config('app.name', 'UFC') }}</title>
    @endif

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/45876f6f9c.js"></script>

    @if(Auth::user())
        @if(Auth::user()->profileThemes->isEmpty())
        @else
        <style type="text/css">
            html{
                min-height: 100% !important;
            }
            body{
                background-image: url({{ asset($selected_theme->bg_image)  }});
                background-color: {{ $selected_theme->bg_color }} !important;
                background-repeat: no-repeat, repeat;
                background-size: cover;
                height: 100%;
            }
            .panel, .btn{
                font-family: {{ $selected_theme->ft_family }} !important;
                font-size: {{ $selected_theme->ft_size }}px !important;
                color: {{ $selected_theme->ft_color }} !important;
            }

            .panel{
                background-color: rgba(255,255,255,0) !important;
            }

            .panel-body{
                background-color: rgba({{ $selected_theme->pnl_color }}, {{ $selected_theme->pnl_opacity }}) !important;
            }

            .panel-body ul li a{
                color: {{ $selected_theme->ft_color }} !important;
            }

            .panel-heading{
                background-color: rgba({{ $selected_theme->pnl_color }}, {{ $selected_theme->pnl_opacity }}) !important;
            }

            .btn-default{
                background-color: {{ $selected_theme->btn_color }} !important;
            }

            .btn-success, .btn-danger{
                color: #fff !important;
            }
        </style>
        @endif
    @endif

    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
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
                        @if(Auth::user())
                            <div>{{ Auth::user()->company }} <img src="{{ asset(Auth::user()->logo) }}" class="img-circle" style="height: 25px;"></div>
                        @else
                            {{ config('app.name', 'UFC') }}
                        @endif
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
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (session('status'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
