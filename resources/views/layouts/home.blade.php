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
                position: relative;
                min-height: 100% !important;
            }
            body{
                background-image: url({{ asset($selected_theme->bg_image)  }});
                background-color: {{ $selected_theme->bg_color }} !important;
                background-repeat: no-repeat, repeat;
                background-size: cover;
                background-attachment: fixed;
                height: 100%;
                margin-bottom: 200px; /* Margin bottom by footer height */
            }
            .btn{
                font-size: {{ $selected_theme->ft_size }}px !important;
            }

            .panel{
                font-family: {{ $selected_theme->ft_family }} !important;
                color: {{ $selected_theme->ft_color }} !important;
                background-color: rgba(255,255,255,0) !important;
            }

            .panel-body{
                background-color: rgba({{ $selected_theme->pnl_color }}, {{ $selected_theme->pnl_opacity }}) !important;
                color: {{ $selected_theme->ft_color }} !important;
            }

            .panel-body ul li a{
                color: {{ $selected_theme->ft_color }} !important;
            }

            .panel-heading{
                background-color: rgba({{ $selected_theme->pnl_color }}, {{ $selected_theme->pnl_opacity }}) !important;
                color: {{ $selected_theme->ft_color }} !important;
            }

            .navbar-default{
                background-color: rgba({{ $selected_theme->pnl_color }}, {{ $selected_theme->pnl_opacity }}) !important;
            }

            .navbar-header {
                float: left;
                padding: 0px;
                text-align: center;
                width: 100%;
            }
            .navbar-brand {
                float:none;
                color: {{ $selected_theme->ft_color }} !important;
            }

            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 200px; /* Set the fixed height of the footer here */
                background-color: rgba({{ $selected_theme->pnl_color }}, {{ $selected_theme->pnl_opacity }}) !important;
                border: none;
                border-top: 1px solid #d3e0e9;
                color: {{ $selected_theme->ft_color }} !important;
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
                    @guest
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @endguest

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @if(Auth::user())
                            <div>{{ Auth::user()->company }} <img src="{{ asset(Auth::user()->logo) }}" class="img-circle" style="height: 25px;"></div>
                        @else
                            {{ config('app.name', 'UFC') }}
                        @endif
                    </a>
                </div>

                @guest
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
                @endguest
            </div>
        </nav>

        @include('flash::message')

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>

        @if(Auth::user())
        <footer class="footer">
            <div class="container">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-6 text-left">
                        <ul class="list-unstyled" style="margin-bottom: 0;">
                            <li><div>{{ Auth::user()->company }} <img src="{{ asset(Auth::user()->logo) }}" class="img-circle" style="height: 25px;"></div></li>
                            <li><i class="fa fa-address-book"></i> {{ Auth::user()->address }}</li>
                        </ul>
                        <hr>
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="list-unstyled" style="margin-bottom: 0;">
                            <li><i class="fa fa-envelope"></i> {{ Auth::user()->email }}</li>
                            <li><i class="fa fa-phone"></i> {{ Auth::user()->contact_number }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        @endif

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
