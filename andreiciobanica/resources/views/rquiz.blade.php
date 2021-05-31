@extends('layouts.app')

@section('content')
<section class="text-center content-section h-100 w-100" id="rezultate_quiz" style="overflow-x: hidden; background: url({{ asset('img/bg-3.jpg') }}) center / cover no-repeat;">
<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto text-dark text-start">
                    @if($verificare)
                    <div class="alert alert-success" role="alert">
                        Felicitări! Ai trecut mai departe! <a href="{{route('lectie', [$id_curs, $nextc, $nextl])}}">Apasă aici pentru a te redirecționa la următoarea lecție!</a>
                    </div>
                    @else
                    <div class="alert alert-danger" role="alert">
                        Ne pare rău, dar trebuie să recitești lecția! <a href="{{route('lectie', [$id_curs, $id_capitol, $id_lectie])}}">Apasă aici pentru a reveni la lecție!</a>
                    </div>
                    @endif
        </div>
    </div>
</div>
</section>
@endsection