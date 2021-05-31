@extends('layouts.app')

@section('content')
<header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-4.jpg') }}) center / cover no-repeat;">
    <div class="intro-body">
        <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="col-sm-10 col-md-10" data-aos="fade-down">
        <div class="card">
                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            Felicitări! Ai reușit să te înscrii la acest curs! <a href="{{route('cursurilemele')}}">Apasă aici pentru a te redirecționa pagina cursului de unde vei putea accesa cursul!</a>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</header>
@endsection