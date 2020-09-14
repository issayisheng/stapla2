@extends('layouts.app')

@section('content')
<p>gym's index</p>

<div class="form-group">
    <label for="gym_name" class="font-weight-bold">{{ __('Gym Name') }}</label>
    @foreach($gyms as $gym)
        @if($gym->owner_id === Auth::user()->id)
            <p><a href="{{ route('gym.show', ['gym_id' => $gym->id]) }}">{{ $gym->name }}</a></p>
        @endif
    @endforeach 
</div>

<a href="{{ route('gym.create') }}" class="btn btn-primary">ジム追加登録</a>

@endsection
        