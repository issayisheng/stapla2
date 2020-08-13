@extends('layouts.auth.app')

@section('content')
<div class="login">
    <div class="container">
        <div class="login__main">
            <h1 class="login__title">新規登録</h1>
            <form class="login-form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="font-weight-bold">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="yamada taro">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="font-weight-bold">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="mail@stapla.net">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="font-weight-bold">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="8文字以上の半角英数記号">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="font-weight-bold">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワードの再入力">
                </div>
                <p>登録することで、<a href="{{ route('terms') }}">利用規約</a>と<a href="{{ route('privacy') }}">プライバシーポリシー</a>に同意したものとみなされます。</p>
                <button type="submit" class="btn-default btn-default--mail">
                    新規登録する
                </button>
            </form>

            <div class="social-login">
                <p class="social-login__deco">または</p>
                <form method=" GET" action="{{ route('login.social',['social'=>'facebook']) }}">
                    @csrf
                    <button type="submit" class="btn-default btn-default--facebook">
                        <img src="img/facebook-logo.svg" alt="Facebook" class="btn-default__logo">Facebookで登録する
                    </button>
                </form>

                <form method="GET" action="{{ route('login.social',['social'=>'google']) }}">
                    @csrf
                    <button type="submit" class="btn-default btn-default--google">
                        <img src="img/google-logo.svg" alt="Google" class="btn-default__logo">Googleで登録する
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection