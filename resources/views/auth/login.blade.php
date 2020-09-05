@extends('layouts.auth.app')

@section('content')
<div class="login form">
    <div class="container">
        <div class="form-logo"><a href="{{route('top')}}" class="form-logo__link">Stapla</a></div>
        <div class="form-main">
            <h1 class="form-main__title">ログイン</h1>
            <form class="layout-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="メールアドレスを入力">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="パスワード">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn-default btn-default--mail">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                <a class="form__link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </form>

            <div class="social-login">
                <p class="social-login__deco">または</p>
                <form method="GET" action="{{ route('login.social',['social'=>'facebook']) }}">
                    @csrf
                    <button type="submit" class="btn-default btn-default--facebook">
                        <img src="img/facebook-logo.svg" alt="Facebook" class="btn-default__logo">Facebookでログイン
                    </button>
                </form>
                <form method="GET" action="{{ route('login.social',['social'=>'google']) }}">
                    @csrf
                    <button type="submit" class="btn-default btn-default--google">
                        <img src="img/google-logo.svg" alt="Google" class="btn-default__logo">Googleでログイン
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection