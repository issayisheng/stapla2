@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">プロフィール編集</div>
                <div class="card-body">
                    <div class="l-form-content">
                        <form action="/settings/user_info/{{ $user_info->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="col-md-4 col-form-label font-weight-bold">氏名</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user_info->name) }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 col-form-label font-weight-bold">メールアドレス</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user_info->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tel" class="col-md-4 col-form-label font-weight-bold">電話番号</label>
                                <input id="tel" type="tel" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel',$user_info->tel) }}">
                                <p>※ハイフン抜き、半角数字で入力してください。</p>
                                @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 col-form-label font-weight-bold">パスワード</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-6 col-form-label font-weight-bold">パスワード (確認用)</label>
                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-secondary" name='action' value='back'>
                                        戻る
                                    </button>
                                    <button type="submit" class="btn btn-primary" name='action' value='edit'>
                                        変更
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection