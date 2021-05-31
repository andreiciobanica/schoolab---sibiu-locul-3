@extends('layouts.app')

@section('content')
<style>
.subtitlu{
    font-size: 16px;
    padding-left: 15px;
    margin: 5px;
        }
.titlu{
    font-size: 24px;
    padding-left: 10px;
    margin: 5px;
        }
</style>
<section class="text-center content-section h-100 w-100" id="about" style="overflow-x: hidden; background: url({{ asset('img/bg-2.jpg') }}) center / cover no-repeat;">
        <div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto text-dark text-start">
            {!! nl2br($lectie->text) !!}
        </div>
    </div>
</div>
</section>
@endsection