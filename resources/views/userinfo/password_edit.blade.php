@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">パスワード変更</div>
                @if (session('change_password_error'))
                <div class="container mt-2">
                    <div class="alert alert-danger mb-0">
                        {{session('change_password_error')}}
                    </div>
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{route('user_info.password.update')}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="current">
                                現在のパスワード
                            </label>
                            <div>
                                <input id="current" type="password" class="form-control" name="current-password" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">
                                新しいパスワード
                            </label>
                            <div>
                                <input id="password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password">
                                @if ($errors->has('new-password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm">
                                新しいパスワード（確認用）
                            </label>
                            <div>
                                <input id="confirm" type="password" class="form-control" name="new-password_confirmation">
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