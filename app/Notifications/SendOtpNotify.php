<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendOtpNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $otp;
    protected $email;
    protected $message;
    protected $header;

    public function __construct($email)
    {
        $this->header = "Reset Password Verification Code";
        $this->message = "Please use this code to reset your password.";
        $this->otp = new Otp;
        $this->email = $email;
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
        // Generate the OTP
        $otp = $this->otp->generate($notifiable->email, 'numeric', 5, 40);

        // Generate the reset URL
        $resetUrl = route('dashboard.password.reset', [
            'email' => $notifiable->email,
            'token' => $otp->token, // Use the OTP token as the reset token
        ]);

        return (new MailMessage)
            ->greeting($this->header)
            ->line($this->message)
            ->line("Your OTP is: **{$otp->token}**") // Display the OTP
            ->line("Click the button below to reset your password:")
            ->action('Reset Password', $resetUrl) // Add the reset URL as a button
            ->line('If you did not request a password reset, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}