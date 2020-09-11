@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">パスワード設定</div>
                @if (session('change_password_error'))
                <div class="container mt-2">
                    <div class="alert alert-danger mb-0">
                        {{session('change_password_error')}}
                    </div>
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{route('user_info.password.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="password">
                                新しいパスワード
                            </label>
                            <div>
                                <input id="password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" placeholder="8文字以上の半角英数記号">
                                @if ($errors->has('new-password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm">
                                新しいパスワード確認
                            </label>
                            <div>
                                <input id="confirm" type="password" class="form-control" name="new-password_confirmation" placeholder="新しいパスワードを再入力">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div>
                                <button type="submit" class="btn btn-secondary" name='action' value='back'>戻る</button>
                                <button type="submit" class="btn btn-primary" name='action' value='edit'>変更</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection