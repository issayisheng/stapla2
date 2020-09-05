@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">チケット購入</div>
                <div class="card-body">
                    @if (session('charge_message'))
                    <div class="alert alert-success py-3 text-center" role="alert">
                        {{ session('charge_message') }}
                    </div>
                    @endif
                    @if (session('errors'))
                    <div class="alert alert-danger py-3" role="alert">
                        {{ session('errors') }}
                    </div>
                    @endif

                    @if(isset( $data ))
                    <p>現在、チケットは<span class="font-weight-bold h1">{{ $data->quantity }}</span>枚です</p>
                    @else
                    <p>現在、チケットは<span class="font-weight-bold h1">0</span>枚です</p>
                    @endif

                    <form action="{{ route('charge') }}" method="POST">
                        {{ csrf_field() }}
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_51HFuIFFuVe19htwq8x2UpTNx4IusSvV1DF3F2YU8k76NOzhpUTvaLDqsxtveQdC21EL7Wy32XzNllHKxgt71OUe500C5XMo1rz" data-amount="1500" data-name="Stapla決済" data-label="チケット5枚購入" data-description="チケット5枚分" data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
                        </script>
                        <input type="hidden" value="5" name="order">
                    </form>
                    <form action="{{ route('charge') }}" method="POST">
                        {{ csrf_field() }}
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_51HFuIFFuVe19htwq8x2UpTNx4IusSvV1DF3F2YU8k76NOzhpUTvaLDqsxtveQdC21EL7Wy32XzNllHKxgt71OUe500C5XMo1rz" data-amount="3000" data-name="Stapla決済" data-label="チケット10枚購入" data-description="チケット10枚分" data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
                        </script>
                        <input type="hidden" value="10" name="order">
                    </form>
                    <a href="{{ route('history.index')}}" class="btn btn-danger">購入履歴</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection