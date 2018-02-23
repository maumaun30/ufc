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
                                    <li><a href="{{ route('profile', encrypt(Auth::user()->id)) }}"><i class="fa fa-user"></i> Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> Logout
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

        @include('flash::message')

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabs
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                                <li><a href="{{ route('current.orders', encrypt(Auth::user()->id)) }}"><i class="fa fa-book"></i> Orders</a></li>
                                <li><a href="{{ route('menu.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-cutlery"></i> Menus</a></li>
                                <li><a href="{{ route('addon.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-beer"></i> Add-ons</a></li>
                                <li><a href="{{ route('inventory.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-barcode"></i> Inventory</a></li>
                                <li><a href="{{ route('sales.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-money"></i> Sales</a></li>
                                <li><a href="{{ route('rating.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-star"></i> Ratings</a></li>
                                <li><a href="{{ route('feedback.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-book"></i> Feedbacks</a></li>
                                <li><a href="{{ route('themes.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-paint-brush"></i> Themes</a></li>
                                <li><a href="{{ route('swiper.index', encrypt(Auth::user()->id)) }}"><i class="fa fa-image"></i> Swiper</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
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
