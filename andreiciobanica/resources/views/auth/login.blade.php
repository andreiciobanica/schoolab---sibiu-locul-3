@extends('layouts.app')

@section('content')
<div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
            <div class="modal-header bg-dark">
              <h5 class="modal-title" id="authModalLabel">Autentificare</h5>
            </div>
            <div class="modal-body bg-dark d-flex">
    <form class="my-auto mx-auto" method="POST" action="{{ route('login') }}">
    @csrf
        <div class="form-group">
        <label for="login">{{ __('Adresă de e-mail sau Nume de utilizator') }}</label>
        <input id="login" type="login" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('username') ?: old('email') }}" required autocomplete="email" autofocus>
        <small id="loginHelp" class="form-text text-muted">Nu vom distribui niciodată e-mailul dvs. cu nimeni altcineva.</small>
        </div>
        @if ($errors->has('username') || $errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
            </span>
        @endif

        <div class="form-group">
            <label for="password">{{ __('Parolă') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

        <div class="form-group">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
            {{ __('Autentifică-mă de fiecare dată') }}
            </label>
            </div>
        </div>

    <button type="submit" class="btn btn-primary btn-lg mt-2">{{ __('Autentifică-te!') }}</button>
    <p>Nu ai un cont?! <a href="{{route('register')}}">Înregistrează-te aici!</a></p>
                                @if (Route::has('password.request'))
                                    <p><a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Ai uitat parola?') }}
                                    </a></p>
                                @endif
    </form>
            </div>
        <div class="modal-footer bg-dark">
            <a href="{{route('home')}}" role="button" class="btn btn-secondary" data-bs-dismiss="modal">Înapoi la pagina principală</a>
        </div>
    </div>
@endsection
