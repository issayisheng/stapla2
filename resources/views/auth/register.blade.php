@extends('layouts.auth.app')

@section('content')
<div class="signup form">
    <div class="container">
        <div class="form-logo"><a href="{{route('top')}}" class="form-logo__link">Stapla</a></div>
        <div class="form-main">
            <h1 class="form-main__title">新規登録</h1>
            <form class="layout-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-bold">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="yamada taro">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="font-weight-bold">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="mail@stapla.net">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="8文字以上の半角英数記号">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form__desc">登録することで、<a href="{{ route('terms') }}" class="form__link">利用規約</a>と<a href="{{ route('privacy') }}" class="form__link">プライバシーポリシー</a>に同意したものとみなされます。</div>
                <button type="submit" class="btn-default btn-default--mail">
                    新規登録する
                </button>
            </form>
            <div class="social-form">
                <p class="social-form__deco">または</p>
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