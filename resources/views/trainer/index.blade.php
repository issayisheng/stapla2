@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">トレーナー管理ページ<br>
                    ジム情報を結び付けて、ボタンからトレーナーのステータス変更させる
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>電話番号</th>
                                <th>メールアドレス</th>
                                <th>ステータス</th>
                                <th>承認ボタン</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->tel}}</td>
                                <td>{{$user->email}}</td>
                                @if ($user->status == 10)
                                <td class="alert alert-success text-center">オーナー</td>
                                @endif
                                @if ($user->status == 5)
                                <td class="alert alert-primary text-center">承認済み</td>
                                @endif
                                @if ($user->status == 0)
                                <td class="alert alert-danger text-center">未承認</td>
                                @endif
                                <td>
                                    <form action="{{route('trainer.edit', $user->id )}}">
                                        @csrf
                                        <button class="btn btn-primary">承認する</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection