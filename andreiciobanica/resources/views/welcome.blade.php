<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Schoolab - Acasă</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=B612">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=B612+Mono">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web">
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('fonts/font-awesome.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/body.css') }}>
    <link rel="stylesheet" href={{ asset('css/scrollbar.css') }}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="77">
<nav class="navbar navbar-light navbar-expand-md fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#" style="font-family: 'Titillium Web', sans-serif;font-size: 28px;">schoolab</a><button data-bs-toggle="collapse" class="navbar-toggler navbar-toggler-right" data-bs-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" value="Menu"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item nav-link"><a class="nav-link active" href="#about" style="font-family: Cabin, sans-serif;">Despre</a></li>
                    <li class="nav-item nav-link"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
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
    <header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-1.jpg') }}) center / cover no-repeat;">
        <div class="intro-body">
            <div class="container animate__animated animate animate__fadeInDown">
                <div class="row justify-content-center">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="brand-heading" style="font-size: 56px;font-family: 'Titillium Web', sans-serif;letter-spacing: 0px;line-height: 60px;">schoolab</h1>
                        <p class="intro-text" style="text-shadow: 4px 0px var(--bs-blue), 2px 0px var(--bs-red), 6px 4px 2px var(--bs-dark);font-family: 'Titillium Web', sans-serif;letter-spacing: 1px;">Îmbunătățiți-vă abilitățile, cunoștințele și creativitatea!<br>Creat de elevi pentru elevi.<br></p><a class="btn btn-link btn-circle" role="button" href="#about"><i class="fa fa-angle-double-down animated"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center content-section h-100 w-100" id="about" style="overflow-x: hidden;">
        <div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 style="font-family: Cabin, sans-serif;" data-aos="fade-down"
     data-aos-easing="linear">Idealurile schoolab</h2>
            <p style="font-family: 'Titillium Web', sans-serif;" data-aos="fade-right"
     data-aos-easing="linear"
     data-aos-duration="1500">Fiind o platformă gratuită, dorim să revoluționăm sistemul școlar prin aducerea în atenția elevilor a acesteia!</p>
            <p style="font-family: 'Titillium Web', sans-serif;" data-aos="fade-left"
     data-aos-easing="linear"
     data-aos-duration="1500">Testează-ți cunoștințele prin jocuri și teste interactive!</p>
            <p style="text-shadow: 2px 0px var(--bs-blue), 4px 0px var(--bs-warning), 5px -2px var(--bs-red), -2px 3px var(--bs-success);font-size: 28px;letter-spacing: 7px;font-family: Lora, serif;" data-aos="fade-up"
     data-aos-easing="linear"
     data-aos-duration="100">Digitalizarea începe odată cu noi!</p>
        </div>
    </div>
</div></section>
    <div class="map-clean" style="height: 80% !important;"><iframe allowfullscreen="" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11397.697021790882!2d24.3632159!3d44.4244589!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x922e57d4498b06d9!2sColegiul%20Na%C8%9Bional%20Ion%20Minulescu!5e0!3m2!1sro!2sro!4v1615487783486!5m2!1sro!2sro" width="100%" height="100%"></iframe></div>
    <footer class="d-flex justify-content-center" style="height: 20% !important;">
        <div class="container text-center mx-auto my-auto">
            <p style="font-family: 'Titillium Web', sans-serif; font-size: 18px;">Copyright © Schoolab 2021</p>
        </div>
    </footer>
    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src={{ asset('js/navbar.js') }}></script>
    <script src={{ asset('js/aos.js') }}></script>
</body>
</html>