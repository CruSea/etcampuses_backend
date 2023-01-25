<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PasswordResetModel;
use Illuminate\Support\Facades\DB;

class PasswordReset extends Notification{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public PasswordResetModel $passwordReset)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $firstName = DB::scalar('select firstName from campusadmin where email = ?', [$this->passwordReset->email]);

        return (new MailMessage)
                    ->subject('Your Password Reset Link')
                    ->greeting('Hello, ' . $firstName)
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->line('Click the button below to reset your password:')
                    ->action('Reset Password', url('https://localhost:8000/reset-password'))
                    ->line('If you did not request a password reset, no further action is required.');
                
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
