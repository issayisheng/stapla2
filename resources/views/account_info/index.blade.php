@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">口座情報</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="list-group mb-3 l-form-content">
                        <a href="{{ route('account_info.edit',$auth->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            口座情報を編集する
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection