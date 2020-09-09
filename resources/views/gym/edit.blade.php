@extends('layouts.app')

@section('content')
<p>gym.edit page</p>
<form class="layout-form" method="POST" action="{{ route('gym.update', ['gym_id'=>$gym->id]) }}">
    @csrf
    <div class="form-group">
        <label for="gym_nadme" class="font-weight-bold">{{ __('Gym Name') }}</label>
        <input id="gym_name" type="gym_name" class="form-control @error('gym_name') is-invalid @enderror" name="gym_name" value="{{ old('gym_name', $gym->name) }}" autocomplete="gym_name" placeholder="">
        @error('gym_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="gym_address" class="font-weight-bold">{{ __('Address') }}</label>
        <input id="gym_address" type="number" class="form-control @error('gym_zipcode') is-invalid @enderror" name="gym_zipcode" value="{{ old('gym_zipcode', $gym->zip_code) }}" autocomplete="gym_zipcode" placeholder="郵便番号">
        <input id="gym_address" type="text" class="form-control @error('gym_prefecture') is-invalid @enderror" name="gym_prefecture" value="{{ old('gym_prefecture', $gym->prefecture) }}" autocomplete="prefecture" placeholder="都道府県">
        <input id="gym_address" type="text" class="form-control @error('gym_city') is-invalid @enderror" name="gym_city" value="{{ old('gym_city', $gym->city) }}" autocomplete="gym_city" placeholder="市区町村">
        <input id="gym_address" type="text" class="form-control @error('gym_street') is-invalid @enderror" name="gym_street" value="{{ old('gym_street', $gym->street) }}" autocomplete="gym_street" placeholder="住所１">
        <input id="gym_address" type="text" class="form-control @error('gym_building') is-invalid @enderror" name="gym_building" value="{{ old('gym_building', $gym->building) }}" autocomplete="gym_building" placeholder="建物名 部屋番号">
        @error('gym_zipcode')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('gym_prefecture')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('gym_city')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('gym_street')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('gym_building')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="gym_tel" class="font-weight-bold">{{ __('Gym Tel') }}</label>
        <input id="gym_tel" type="tel" class="form-control @error('gym_tel') is-invalid @enderror" name="gym_tel" value="{{ old('gym_tel', $gym->tel) }}" autocomplete="gym_tel" placeholder="">
        @error('gym_tel')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="gym_facility" class="font-weight-bold">{{ __('Gym Facility') }}</label>
        <input id="gym_facility" type="gym_facility" class="form-control @error('gym_facility') is-invalid @enderror" name="gym_facility" value="{{ old('gym_facility', $gym->gym_facility) }}" autocomplete="gym_facility" placeholder="">
        @error('gym_facility')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="" class="font-weight-bold">{{ __('Gym Opening Hour') }}</label>
    </div>
    <div class="form-group">
        <label for="mon_opening_hour" class="font-weight-bold">{{ __('Mon Opening Hour') }}</label>
        <input id="mon_opening_hour" type="time" class="form-control @error('mon_open') is-invalid @enderror" name="mon_open" value="{{ old('mon_open', $gym->mon_opening_started) }}" autocomplete="mon_open" placeholder="">
        <input id="mon_opening_hour" type="time" class="form-control @error('mon_opening_hour') is-invalid @enderror" name="mon_close" value="{{ old('mon_close', $gym->mon_opening_ended) }}" autocomplete="mon_close" placeholder="">
        @error('mon_open')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('mon_close')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="tue_opening_hour" class="font-weight-bold">{{ __('Tue Opening Hour') }}</label>
        <input id="tue_opening_hour" type="time" class="form-control @error('tue_open') is-invalid @enderror" name="tue_open" value="{{ old('tue_open', $gym->tue_opening_started) }}" autocomplete="tue_open" placeholder="">
        <input id="tue_opening_hour" type="time" class="form-control @error('tue_close') is-invalid @enderror" name="tue_close" value="{{ old('tue_close', $gym->tue_opening_ended) }}" autocomplete="tue_close" placeholder="">
        @error('tue_open')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('tue_close')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="wed_opening_hour" class="font-weight-bold">{{ __('Wed Opening Hour') }}</label>
        <input id="wed_opening_hour" type="time" class="form-control @error('wed_open') is-invalid @enderror" name="wed_open" value="{{ old('wed_open', $gym->wed_opening_started) }}" autocomplete="wed_open" placeholder="">
        <input id="wed_opening_hour" type="time" class="form-control @error('wed_close') is-invalid @enderror" name="wed_close" value="{{ old('wed_close', $gym->wed_opening_ended) }}" autocomplete="wed_close" placeholder="">
        @error('wed_open')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('wed_close')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="thu_opening_hour" class="font-weight-bold">{{ __('Thu Opening Hour') }}</label>
        <input id="thu_opening_hour" type="time" class="form-control @error('thu_open') is-invalid @enderror" name="thu_open" value="{{ old('thu_open', $gym->thu_opening_started) }}" autocomplete="thu_open" placeholder="">
        <input id="thu_opening_hour" type="time" class="form-control @error('thu_close') is-invalid @enderror" name="thu_close" value="{{ old('thu_close', $gym->thu_opening_ended) }}" autocomplete="thu_close" placeholder="">
        @error('thu_open')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('thu_close')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="fri_opening_hour" class="font-weight-bold">{{ __('Fri Opening Hour') }}</label>
        <input id="fri_opening_hour" type="time" class="form-control @error('fri_open') is-invalid @enderror" name="fri_open" value="{{ old('fri_open', $gym->fri_opening_started) }}" autocomplete="fri_open" placeholder="">
        <input id="fri_opening_hour" type="time" class="form-control @error('fri_close') is-invalid @enderror" name="fri_close" value="{{ old('fri_close', $gym->fri_opening_ended) }}" autocomplete="fri_close" placeholder="">
        @error('fri_open')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('fri_close')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="sat_opening_hour" class="font-weight-bold">{{ __('Sat Opening Hour') }}</label>
        <input id="sat_opening_hour" type="time" class="form-control @error('sat_open') is-invalid @enderror" name="sat_open" value="{{ old('sat_open', $gym->sat_opening_started) }}" autocomplete="sat_open" placeholder="">
        <input id="sat_opening_hour" type="time" class="form-control @error('sat_close') is-invalid @enderror" name="sat_close" value="{{ old('sat_close', $gym->sat_opening_ended) }}" autocomplete="sat_close" placeholder="">
        @error('sat_open')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('sat_close')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="sun_opening_hour" class="font-weight-bold">{{ __('Sun Opening Hour') }}</label>
        <input id="sun_opening_hour" type="time" class="form-control @error('sun_open') is-invalid @enderror" name="sun_open" value="{{ old('sun_open', $gym->sun_opening_started) }}" autocomplete="sun_open" placeholder="">
        <input id="sun_opening_hour" type="time" class="form-control @error('sun_close') is-invalid @enderror" name="sun_close" value="{{ old('sun_close', $gym->sun_opening_ended) }}" autocomplete="sun_close" placeholder="">
        @error('sun_open')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error('sun_close')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn-default">
        修正
    </button>
</form>


@endsection