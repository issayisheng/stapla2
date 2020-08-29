@extends('layouts.auth.app')

@section('content')
<div class="form password-reset">
    <div class="container">
        <div class="form-logo"><a href="{{route('top')}}" class="form-logo__link">Stapla</a></div>
        <div class="form-main">
            <h1 class="form-main__title">パスワード再設定</h1>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form class="layout-form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="メールアドレスを入力">
                    <p class="password-reset__info">パスワード再設定のためのご案内メールを、ご登録されたメールアドレスに送信されます。</p>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group text-center mb-0">
                    <button type="submit" class="btn-default btn-default--mail">
                        送信する
                    </button>
                </div>
            </form>
            <a href="{{ route('login') }}" class="password-reset__link">ログイン画面に戻る</a>
        </div>
    </div>
</div>
@endsection