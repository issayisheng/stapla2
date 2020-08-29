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
                        <div class="col-sm-12 col-md-6 col-lg-4 px-0 px-md-3">
                            <div class="card mb-3 mb-lg-0">
                                <img class="card-img-top" src="img/gym1.jpg" alt="PALプライベートジム学芸大学">
                                <div class="card-body">
                                    <h5 class="card-title">PALプライベートジム学芸大学</h5>
                                    <p class="card-text">東急東横線学芸大学駅徒歩２分に位置するパーソナルジム</p>
                                    <div class="text-center"><a href="#" class="btn btn-primary">予約する</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 px-0 px-md-3">
                            <div class="card mb-3 mb-lg-0">
                                <img class="card-img-top" src="img/gym2.jpg" alt="PALプライベートジム烏丸御池">
                                <div class="card-body">
                                    <h5 class="card-title">PALプライベートジム烏丸御池</h5>
                                    <p class="card-text">京都市営地下鉄烏丸御池駅より徒歩5分に位置するパーソナルジム</p>
                                    <div class="text-center"><a href="#" class="btn btn-success">予約する</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 px-0 px-md-3">
                            <div class="card mb-3 mb-lg-0">
                                <img class="card-img-top" src="img/gym3.jpg" alt="PALプライベートジム豊中">
                                <div class="card-body">
                                    <h5 class="card-title">PALプライベートジム豊中</h5>
                                    <p class="card-text">大阪モノレール柴原阪大前駅より徒歩12分に位置するプライベートジム</p>
                                    <div class="text-center"><a href="#" class="btn btn-danger">予約する</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection