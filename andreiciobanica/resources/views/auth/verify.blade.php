@extends('layouts.app')

@section('content')
<header class="masthead h-100 w-100" style="background: url({{ asset('img/bg-4.jpg') }}) center / cover no-repeat;">
    <div class="intro-body">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark">{{ __('Verificați-vă adresa de e-mail!') }}</div>

                <div class="card-body text-dark">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un link nou de verificare a fost trimis către adresa dvs. de e-mail.') }}
                        </div>
                    @endif

                    {{ __('Înainte de a intra pe această pagină sau de a avea toate beneficiile pentru utilizarea acestei platforme vă rugăm să vă verificați contul!') }}
                    {{ __('Dacă nu ați primit mail-ul') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click aici pentru a vă trimite alt link') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</header>
@endsection
