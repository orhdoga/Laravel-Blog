<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="https://laravel.com/favicon.png">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px;">
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
                        <span class="logo-flair">
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li {{{ (Request::is('threads') ? 'class=active' : '') }}}

                        @php
                            $threadId = isset($thread->id) ? $thread->id : "";
                            $userId = isset($user->name) ? $user->name : "";
                        @endphp

                        @foreach ($tags as $tag) {
                            @if (Request::is('threads/' . $tag->name))
                                {{ "class=active" }}
                            @elseif (Request::is('threads/' . $tag->name . '/' . $threadId))
                                {{ "class=active" }}
                            @elseif (Request::is('users/' . strtolower($userId)))
                                {{ "class=active" }}
                            @else
                                {{ "" }}
                            @endif
                        @endforeach    
                        >
                            <a href="{{ url('/threads') }}"><i class="fa fa-users" aria-hidden="true"></i> Community</a>
                        </li>

                        @if (Auth::user())
                            <li {{{ (Request::is('threads/create') ? 'class=active' : '') }}}>
                                <a href="{{ url('/threads/create') }}"><i class="fa fa-plus-square" aria-hidden="true"></i> New Thread</a>
                            </li>
                        @endif

                        @if (Auth::id() === 1)
                            <li {{ (Request::is('users') ? 'class=active' : '') }}>
                                <a href="{{ url('/users') }}"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
                            </li>
                        @endif
                            
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position: relative; padding-left: 50px;">
                                    <img src="{{ asset("/icons/" . Auth::user()->icon) }}" class="user-menu-icon">
                                    <span class="user-flair">{{ str_replace('-', ' ', Auth::user()->name) }}</span> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/users/' . str_replace(' ', '-', strtolower(Auth::user()->name))) }}">
                                            <i class="fa fa-user" aria-hidden="true"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
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

        <div class="container">
            @include('flash::message')
        </div>    

        @yield('content')
    </div> 

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>   

</body>
</html>
