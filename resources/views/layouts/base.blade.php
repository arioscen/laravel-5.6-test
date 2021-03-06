<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <style>
        .sidebar-item:hover {
            background-color: black;
        }
    </style>    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><a class="navbar-brand" href="#">Arioscen</a></nav>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Arioscen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" v-bind:class="groupObject">
                    <a class="nav-link" href="{{ url('groups') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown" v-bind:class="userObject">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('user/groups') }}">Groups</a>
                    </div>
                </li>
                <li class="nav-item" v-bind:class="fileObject">
                    <a class="nav-link" href="{{ url('user/files') }}">File</a>
                </li>                
            </ul>  
            <ul class="navbar-nav ml-auto">
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Config::get('languages')[App::getLocale()] }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li>
                                    <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>                    
                </li>
            </ul>                      
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div style="width:15%"></div>
            <nav class="d-none d-sm-block navbar-dark bg-dark position-fixed py-3" style="min-height: 100vh; width:15%">
                <ul class="navbar-nav flex-column">
                    <li class="sidebar-item nav-item" data-toggle="collapse" data-target="#test001">
                        <a class="nav-link ml-3" href="#"><i class="fa fa-fw fa-desktop"></i> Test001</a>
                    </li>
                    <div class="collapse bg-secondary" id="test001">
                        <li class="nav-item mt-1 ml-5">
                            <a class="nav-link" href="#">Test001-1</a>
                            <a class="nav-link" href="#">Test001-2</a>
                        </li>
                    </div>
                    <li class="sidebar-item nav-item" data-toggle="collapse" data-target="#test002">
                        <a class="nav-link ml-3" href="#"><i class="fa fa-fw fa-desktop"></i> Test002</a>
                    </li>
                    <div class="collapse bg-secondary" id="test002">
                        <li class="nav-item mt-1 ml-5">
                            <a class="nav-link" href="#">Test002-1</a>
                            <a class="nav-link" href="#">Test002-2</a>
                        </li>
                    </div>
                </ul>
            </nav>
            
            <main class="col-10 py-4">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show">
                        {!! implode('<br>', $errors->all()) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                
                    </div>
                    
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                 
                    </div>
                @endif            
                @yield('content')
            </main>            
        </div>
    </div>
    <script>
        var vm = new Vue({
            el: "#navbarSupportedContent",
            data: {
                groupObject: {
                    active: '{{ Request::path() }}' == 'groups' 
                },
                userObject: {
                    active: '{{ Request::path() }}' == 'user/groups' 
                },                
                fileObject: {
                    active: '{{ Request::path() }}' == 'user/files' 
                },
            }
        })
    </script>
</body>
</html>
