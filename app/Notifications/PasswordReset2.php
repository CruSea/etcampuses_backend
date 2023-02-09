<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\CampusAdmin;
use Illuminate\Support\Facades\DB;

class PasswordReset2 extends Notification{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public CampusAdmin $campusAdmin, public String $resetKey)
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
        return (new MailMessage)
                    ->subject('Your Password Reset Link')
                    ->greeting('Hello, ' . $this->campusAdmin->firstName)
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->line('Click the button below to reset your password:')
                    ->action('Reset Password', url('https://localhost:8000/reset-password/' . $this->resetKey)) //React URL plus uuid                    
                    ->line('If you did not request a password reset, no further action is required.')
                    ->line('Note: This password reset link will expire in 15 minutes.');
                
                    
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
