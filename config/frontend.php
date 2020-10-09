<?php
return [
    'url' => env('FRONTEND_URL'), //フロントエンドのURL
    'reset_pass_url' => env('RESET_PASS_URL', '/reset?queryURL='), // フロントエンドのパスワードリセットページのURL
    'email_verify_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/verify?queryURL='), // メール認証のURL
];
