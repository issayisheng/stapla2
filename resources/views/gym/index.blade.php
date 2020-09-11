@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">gym's index</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="gym_name" class="font-weight-bold">{{ __('Gym Name') }}</label>
                        {{-- {{ dd($gyms)}} --}}

                        @foreach($gyms as $gym)
                        <p>{{ $gym->name }}</p>
                        <div><a href="{{ route('gym.show', ['gym_id' => $gym->id]) }}" class="btn btn-outline-primary">編集する</a></div>
                        @endforeach
                    </div>
                    <a href="{{ route('gym.create') }}" class="btn btn-primary">ジム追加登録</a>
                    @endsection
                </div>
            </div>
        </div>
    </div>
</div>