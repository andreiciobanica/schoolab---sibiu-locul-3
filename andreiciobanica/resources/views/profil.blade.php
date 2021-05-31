@extends('layouts.app')

@section('content')
<header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-4.jpg') }}) center / cover no-repeat;">
    <div class="intro-body">
        <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="col-sm-10 col-md-10" data-aos="fade-down">
                <div class="card">
                    <div class="card-header bg-dark text-white">Profilul meu</div>
                        <div class="card-body">
                            <div class="menu">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                    <img class="img-fluid" height="150" width="150" src="@if(!file_exists(public_path('avatar/'.Auth::user()->avatar))){{Avatar::create(Auth::user()->username)->toBase64()}} @else {{'../../avatar/'.Auth::user()->avatar}} @endif"/>
                                    <form action="{{route('sadp')}}" name="sap" id="sap" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group mb-3 pt-3">
                                                    <input type="file" class="form-control" aria-label="Default" name='avatar' id='avatar formFileSm' aria-describedby="inputGroup-sizing-default">
                                                </div>
                                                <button class="btn btn-primary" form="sap" style="margin-top: 20px;">Schimbă poza de profil!</button>
                                            </form>
                                    </div>
                                    <div class="col-md-8">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nume</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Adresă de e-mail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <th scope="row">{{Auth::user()->id}}</th>
                                            <td>{{Auth::user()->name}}</td>
                                            <td>{{Auth::user()->username}}</td>
                                            <td>{{Auth::user()->email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection