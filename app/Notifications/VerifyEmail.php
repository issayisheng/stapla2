<?php

namespace App\Notifications;

use App;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends VerifyEmailBase
{
    protected function verificationUrl($user)
    {
        $prefix = 'http://localhost.stapla.com';
        $routeName = 'verification.verify';
        $temporarySignedURL = URL::temporarySignedRoute(
            $routeName,
            Carbon::now()->addMinutes(30),
            ['id' => $user->getKey()]
        );

        return $prefix.urlencode($temporarySignedURL);
    }
}
