<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->toke = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Reset Password - Your Website Name')
                    ->line('مرحبا بك')
                    ->action('Reset', route('password.reset', $this->token))
                    ->action('Notification Action', url('/'))
                    ->line('شكرا لإختيار متجرنا');

                    return (new MailMessage)
        ->subject('Reset Password - Your Website Name')
        ->line('You are receiving this email because we received a password reset request for your account.')
        ->action('Reset Password', $this->url)
        ->line('If you did not request a password reset, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
