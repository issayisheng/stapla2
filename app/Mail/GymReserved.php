<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Calendar;
use App\User;

class GymReserved extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * インスタンス
    *
    */

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user      = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('ご予約完了のお知らせ')
        ->view('emails.reserved');
    }
}
