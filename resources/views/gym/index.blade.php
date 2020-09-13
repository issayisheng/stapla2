@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">ジム管理ページ <a href="{{ route('gym.create') }}" class="btn btn-danger float-right">ジム追加登録</a></div>
                <div class="card-body">
                    <div class="card-group">
                        @foreach($gyms as $gym)
                        <div class="col-sm-12 col-md-6 col-lg-4 px-0 px-md-3">
                            <div class="card mb-3 mb-lg-0">
                                @if($gym->gym_image == null)
                                <img class="card-img-top" src="/public/gym/noimage.png">
                                @else
                                <img class="card-img-top" src="{{ asset('public/gym/' . $gym->gym_image) }}" alt="{{ $gym->name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $gym->name }}</h5>
                                    <div class="text-center"><a href="{{ route('gym.show', ['gym_id' => $gym->id]) }}" class="btn btn-outline-primary">詳細をみる</a></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection