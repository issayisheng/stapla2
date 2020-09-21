@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">マイページ</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="list-group mb-3 l-form-content">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="font-weight-bold">お名前</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$users->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="font-weight-bold">メールアドレス</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$users->email}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="font-weight-bold">電話番号</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$users->tel}}</p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <a href="{{ route('user_info.edit',$users->id) }}" class="btn btn-primary mr-5">編集する</a>
                            @if ($users->password === null || $users->password === '')
                            <a href="{{ route('user_info.password.create') }}" class="btn btn-danger">パスワード設定</a>
                            @else
                            <a href="{{ route('user_info.password.edits') }}" class="btn btn-outline-primary">パスワード変更</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection