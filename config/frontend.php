<?php
return [
    'url' => env('FRONTEND_URL'), //フロントエンドのURL
    'reset_pass_url' => env('RESET_PASS_URL', '/reset?queryURL='), // フロントエンドのパスワードリセットページのURL
];
