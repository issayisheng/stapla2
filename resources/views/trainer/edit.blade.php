@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">トレーナー管理ページ(編集中)
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>電話番号</th>
                                <th>メールアドレス</th>
                                <th class="text-center" colspan="3">承認ボタン</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$auth->name}}</td>
                                <td>{{$auth->tel}}</td>
                                <td>{{$auth->email}}</td>
                                <td class="text-center">
                                    <form action="/settings/trainer/{{ $auth->id }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">承認する</button>
                                        <input id="role" type="hidden" name="role" value="5">
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="/settings/trainer/{{ $auth->id }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">無効する</button>
                                        <input id="role" type="hidden" name="role" value="0">
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('trainer.index')}}" class="btn btn-secondary" role="button">戻る</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection