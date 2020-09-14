@extends('layouts.app')

@section('content')
@if (session('completed'))
<div class="">
    <p>{{ session('done') }}</p>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">gym.show page</div>
                <div class="form-group">
                    <label for="gym_tel" class="font-weight-bold">{{ __('Gym Tel') }}</label>
                    <p>{{ $gym->tel }}</p>
                </div>
                <div class="form-group">
                    <label for="gym_tel" class="font-weight-bold">{{ __('Introduction Pic') }}</label>
                    @if($gym->gym_image == null)
                    <p>現在、{{ __('Introduction Pic') }}が設定されていません。</p>
                    @else
                    <img class="card-img-top" src="{{ env('AWS_URL').$gym->introduction_pic }}" alt="{{ $gym->name }}">
                    @endif
                </div>
                <div class="form-group">
                    <label for="gym_tel" class="font-weight-bold">{{ __('Introduction Text') }}</label>
                    <p>{{ $gym->introduction_text }}</p>
                </div>
                <div class="form-group">
                    <label for="gym_name" class="font-weight-bold">{{ __('Gym Name') }}</label>
                    <p>{{ $gym->name }}</p>
                </div>
                <div class="form-group">
                    <label for="gym_address" class="font-weight-bold">{{ __('Zip Code') }}</label>
                    <p>{{ $gym->zip_code }}</p>
                </div>
                <div class="form-group">
                    <label for="gym_address" class="font-weight-bold">{{ __('Address') }}</label>
                    <p>{{ $gym->address }}{{ $gym->city }}{{ $gym->street }}{{ $gym->building }}</p>
                </div>
                <div class="form-group">
                    <label for="gym_tel" class="font-weight-bold">{{ __('Gym Tel') }}</label>
                    <p>{{ $gym->tel }}</p>
                </div>
                <div class="form-group">
                    <label for="gym_facility" class="font-weight-bold">{{ __('Gym Facility') }}</label>
                    @isset($gym->facility)
                    <p>{{ $gym->facility }}</p>
                    @else
                    <p>詳細はオーナにお問い合わせください。</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold">{{ __('Gym Opening Hour') }}</label>
                </div>
                @if ((isset($gym->mon_opening_started) && isset($gym->mon_opening_ended)) || (isset($gym->tue_opening_started) && isset($gym->tue_opening_ended))
                || (isset($gym->wed_opening_started) && isset($gym->wed_opening_ended)) || (isset($gym->thu_opening_started) && isset($gym->thu_opening_ended))
                || (isset($gym->fri_opening_started) && isset($gym->fri_opening_ended)) || (isset($gym->sat_opening_started) && isset($gym->sat_opening_ended))
                || (isset($gym->sun_opening_started) && isset($gym->sun_opening_ended)))
                <div class="form-group">
                    <label for="mon_opening_hour" class="font-weight-bold">{{ __('Mon Opening Hour') }}</label>
                    @if(isset($gym->mon_opening_started) && isset($gym->mon_opening_ended))
                    <p>{{ $gym->mon_opening_started }} ~ {{ $gym->mon_opening_ended }}</p>
                    @else
                    <p>Close</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="tue_opening_hour" class="font-weight-bold">{{ __('Tue Opening Hour') }}</label>
                    @if(isset($gym->tue_opening_started) && isset($gym->tue_opening_ended))
                    <p>{{ $gym->tue_opening_started }} ~ {{ $gym->tue_opening_ended }}</p>
                    @else
                    <p>Close</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="wed_opening_hour" class="font-weight-bold">{{ __('Wed Opening Hour') }}</label>
                    @if(isset($gym->wed_opening_started) && isset($gym->wed_opening_ended))
                    <p>{{ $gym->wed_opening_started }} ~ {{ $gym->wed_opening_ended }}</p>
                    @else
                    <p>Close</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="thu_opening_hour" class="font-weight-bold">{{ __('Thu Opening Hour') }}</label>
                    @if(isset($gym->thu_opening_started) && isset($gym->thu_opening_ended))
                    <p>{{ $gym->thu_opening_started }} ~ {{ $gym->thu_opening_ended }}</p>
                    @else
                    <p>Close</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="fri_opening_hour" class="font-weight-bold">{{ __('Fri Opening Hour') }}</label>
                    @if(isset($gym->fri_opening_started) && isset($gym->fri_opening_ended))
                    <p>{{ $gym->fri_opening_started }} ~ {{ $gym->fri_opening_ended }}</p>
                    @else
                    <p>Close</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="sat_opening_hour" class="font-weight-bold">{{ __('Sat Opening Hour') }}</label>
                    @if(isset($gym->sat_opening_started) && isset($gym->sat_opening_ended))
                    <p>{{ $gym->sat_opening_started }} ~ {{ $gym->sat_opening_ended }}</p>
                    @else
                    <p>Close</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="sun_opening_hour" class="font-weight-bold">{{ __('Sun Opening Hour') }}</label>
                    @if(isset($gym->sun_opening_started) && isset($gym->sun_opening_ended))
                    <p>{{ $gym->sun_opening_started }} ~ {{ $gym->sun_opening_ended }}</p>
                    @else
                    <p>Close</p>
                    @endif
                </div>
                @else
                <p>詳細はオーナにお問い合わせください。</p>
                @endif
                <div>
                    @if($gym->owner_id === $current_user->id)
                    <a href="{{ route('gym.edit', ['gym_id' => $gym->id]) }}" class="btn btn-primary">編集</a>
                    @endif
                    <a href="{{ route('gym.index') }}" class="btn btn-primary">ジム一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection