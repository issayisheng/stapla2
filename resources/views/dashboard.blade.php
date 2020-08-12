@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ジムを予約する</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card-deck">
                        <div class="card">
                            <img class="card-img-top" src="img/gym1.jpg" alt="PALプライベートジム学芸大学">
                            <div class="card-body">
                                <h5 class="card-title">PALプライベートジム学芸大学</h5>
                                <p class="card-text">東急東横線学芸大学駅徒歩２分に位置するパーソナルジム</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="img/gym2.jpg" alt="PALプライベートジム烏丸御池">
                            <div class="card-body">
                                <h5 class="card-title">PALプライベートジム烏丸御池</h5>
                                <p class="card-text">京都市営地下鉄烏丸御池駅より徒歩5分に位置するパーソナルジム</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="img/gym3.jpg" alt="PALプライベートジム豊中">
                            <div class="card-body">
                                <h5 class="card-title">PALプライベートジム豊中</h5>
                                <p class="card-text">大阪モノレール柴原阪大前駅より徒歩12分に位置するプライベートジム</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection