@extends('layouts.app')

@section('content')
<div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
        <div class="modal-header bg-dark">
            <h5 class="modal-title" id="authModalLabel">Înregistrare</h5>
        </div>
    
        <div class="modal-body bg-dark d-flex">
            <form name="signup" class="my-auto mx-auto" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Nume și prenume') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">{{ __('Nume de utilizator') }}</label>
                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="@username" required autocomplete="username">
                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('Adresă de e-mail') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Parolă') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirmare parolă') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            
            <small class="form-text text-muted">Datele sunt confidențiale și doar proprietarul contului are acces la acestea!</small>
            <button type="submit" class="btn btn-primary btn-lg mt-2">Înregistrează-te!</button>
            <p>Ai deja cont?! <a href="{{ route('login') }}">Autentifică-te aici!</a></p>
            </form>  

        </div>

        <div class="modal-footer bg-dark">
            <a href="{{route('home')}}" role="button" class="btn btn-secondary" data-bs-dismiss="modal">Înapoi la pagina principală</a>
        </div>
    </div>
</div>
@endsection
