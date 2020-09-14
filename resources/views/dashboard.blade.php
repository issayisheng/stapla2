@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">ジムを予約する</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card-group">
                        @foreach($gyms as $gym)
                        <div class="col-sm-12 col-md-6 col-lg-4 px-0 px-md-3">
                            <div class="card mb-3">
                                @if($gym->gym_image == null)
                                <img class="card-img-top" src="/public/gym/noimage.png">
                                @else
                                <img class="card-img-top" src="{{ env('AWS_URL').$gym->introduction_pic }}" alt="{{ $gym->name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $gym->name }}</h5>
                                    <p class="card-text">{{ $gym->introduction_text }}</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('gym.show', ['gym_id'=>$gym->id]) }}" class="btn page-link text-dark d-inline-block mr-3">詳細をみる</a>
                                        <a href="#" class="btn btn-danger">予約する</a>
                                    </div>
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