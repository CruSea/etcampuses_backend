<?php

namespace App\Listeners;

use App\Events\PasswordChangeRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PasswordReset;

class SendEmailResetNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PasswordChangeRequested  $event
     * @return void
     */
    public function handle(PasswordChangeRequested $event)
    {
        $event->passwordReset->notify(new PasswordReset($event->passwordReset));
    }
}
