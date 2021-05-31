@extends('layouts.app')

@section('content')
<header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-2.jpg') }}) center / cover no-repeat;">
    <div class="intro-body">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="col-sm-10 col-md-10" data-aos="fade-down">
                <div class="card">
                    <div class="card-header bg-dark text-white">Contactați-ne!</div>
                        <div class="card-body text-dark">
                            <div class="menu">
                                <div class="row">
                                <form action="" class="text-start" name="contact" method="POST">
                                    <div class="mb-3">
                                    <label for="name" class="form-label">Nume și prenume</label>
                                    <input type="text" class="form-control" id="name" placeholder="Nume și prenume">
                                    </div>
                                    <div class="mb-3">
                                    <label for="email" class="form-label">Adresă de e-mail</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                    </div>
                                    <div class="mb-3">
                                    <label for="mesaj" class="form-label">Mesajul dvs.</label>
                                    <textarea class="form-control" id="mesaj" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Trimite!</button>
                                </form>
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
