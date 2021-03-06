<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
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
                        @if (Auth::guard('web')->check())
                            <li class="{{Request::is(route('admin.login')) ? 'active' : ''}}">
                                <a href="{{ route('admin.login') }}">Admin Login</a>
                            </li>
                            <li>
                                <a href="{{ route('student.logout') }}">Log Out</a>
                            </li>
                        @elseif(Auth::guard('admin')->check())
                            <li class="{{Request::is(route('admin.hallmess')) ? 'active' : ''}}">
                                <a href="{{ route('admin.hallmess') }}">Dining Payment</a>
                            </li>
                            <li class="{{Request::is(route('admin.insertstudent')) ? 'active' : ''}}">
                                <a href="{{ route('admin.studentdata') }}">Student Data</a>
                            </li>
                            <li class="{{Request::is(route('student.login')) ? 'active' : ''}}">
                                <a href="{{ route('student.login') }}">Student Login</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}">Log Out</a>
                            </li>
                        @else
                            <li class="{{Request::is(route('student.login')) ? 'active' : ''}}">
                                <a href="{{ route('student.login') }}">Student Login</a>
                            </li>
                            <li class="{{Request::is(route('admin.login')) ? 'active' : ''}}">
                                <a href="{{ route('admin.login') }}">Admin Login</a>
                            </li>


                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        @include('includes.flashmesseges')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- App scripts -->
    @stack('scripts')
</body>
</html>
