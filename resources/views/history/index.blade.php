@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">チケット購入</div>
                <div class="card-body">
                    @isset($items)
                    @foreach ($items as $item)
                    <div class="list-group">
                        <div class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">チケット購入日{{ $item->created_at->format('Y年m月d日 H時i分') }}</h5>
                                <h5 class="mb-1">数量{{ $item->order }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>購入履歴はありません</p>
                    @endisset
                    <a href="{{ route('ticket.index')}}" class="btn btn-success">チケット購入へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection