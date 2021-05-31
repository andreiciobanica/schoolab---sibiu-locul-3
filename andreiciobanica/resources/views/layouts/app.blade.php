<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titlu')</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=B612">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=B612+Mono">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('fonts/font-awesome.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/body.css') }}>
    <link rel="stylesheet" href={{ asset('css/scrollbar.css') }}>

</head>
<body id="page-top" data-bs-target="#mainNav" data-bs-offset="77">
@if(Route::currentRouteName()!='login' && Route::currentRouteName()!='register')
    <nav class="navbar navbar-light navbar-expand-md fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#" style="font-family: 'Titillium Web', sans-serif;font-size: 28px;">schoolab</a><button data-bs-toggle="collapse" class="navbar-toggler navbar-toggler-right" data-bs-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" value="Menu"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item nav-link"><a class="nav-link" href="{{ route('home')}}#about" style="font-family: Cabin, sans-serif;">Despre</a></li>
                    <li class="nav-item nav-link"><a class="nav-link @if(Route::currentRouteName()==='contact') active @endif" href="{{ route('contact') }}">Contact</a></li>
                    @guest
                            @if (Route::has('login') && Route::has('register'))
                            <li class="nav-item nav-link"><a class="text-white" href="{{ route('login') }}">Autentificare</a></li>
                            @endif
                    @else
                <li class="nav-item nav-link"><a class="nav-link @if(Route::currentRouteName()==='cursuri') active @endif" href="{{ route('cursuri') }}">Cursuri</a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle @if(Route::currentRouteName()==='profil') active @endif" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                <a href="{{ route('profil') }}" class="dropdown-item"><img class="img-fluid" height="50" width="50" src="@if(!file_exists(public_path('avatar/'.Auth::user()->avatar))){{Avatar::create(Auth::user()->username)->toBase64()}} @else {{'../../../avatar/'.Auth::user()->avatar}} @endif"/>Profil</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                <a class="dropdown-item" href="{{ route('cursurilemele') }}">Cursurile mele</a>
          </ul>
        </li>
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
@endif

@yield('content')

    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src={{ asset('js/navbar.js') }}></script>
    <script src={{ asset('js/aos.js') }}></script>
    @if(Route::currentRouteName()==="problema")
    <script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="/ace-builds/src-noconflict/ext-language_tools.js"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setOptions({
            enableLiveAutocompletion: true
        });
        editor.setTheme("ace/theme/dracula");
        editor.session.setMode("ace/mode/c_cpp");
        editor.session.setUseSoftTabs(true);
        editor.setAutoScrollEditorIntoView(true);
        editor.renderer.setScrollMargin(10, 10, 10, 10);
        var edit = $('#editor');
            edit.closest('form').submit(function() {
                var code = editor.getValue();
                $('#codproblema').val(code);
            });
    </script>
    @endif
</body>
</html>
