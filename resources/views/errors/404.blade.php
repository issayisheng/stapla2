<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        height: 100vh;
        margin: 0;
        font-size: 16px;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 36px;
        padding: 20px;
    }
</style>
<body>
    <div class="flex-center full-height">
        <div class="content">
            <h1 class="title">404 Not Found </h1>
            <p class="error-message">お探しのページは存在しません。 </p>
            <div class="error-detail mb-5">もしくは一時的にアクセスできないか、移動または削除された可能性があります。<br>URLに間違いがないかご確認をお願いいたします。</div>
            <p><a href="{{ route('top')}}" class="btn btn-primary">ホームへ戻る</a></p>
        </div>
    </div>
</body>
</html>