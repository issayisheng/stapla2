<h3>
    <a href="{{ config('app.url') }}">Stapla</a>
</h3>
<p>下のリンクをクリックしてパスワードをリセットしてください。<br>
    このメールに心当たりがない場合や、パスワードの再設定が不要な場合は、メールを破棄してください。
</p>
<p>
    {{$actionText}}: <a href="{{$actionUrl}}">{{$actionUrl}}</a>
</p>