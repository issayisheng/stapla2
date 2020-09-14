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
                            <div class="card mb-3 mb-lg-0">
                                <img class="card-img-top" src="{{ env('AWS_URL').$gym->introduction_pic }}" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('gym.show', ['gym_id'=>$gym->id]) }}">{{ $gym->name }}</a></h5>
                                    <p class="card-text">{{ $gym->introduction_text }}</p>
                                    <div class="text-center"><a href="#" class="btn btn-primary">予約する</a></div>
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