<?php

namespace App\Notifications;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailCustomerVerfication extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $user;

    public function __construct(Customer $user) {
        $this->delay = 1;
        $this->user  = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $verificationUrl = url('verify/customer/email/'.$this->user->email_token);

        return (new MailMessage)
            ->subject(trans('mail.email_verification_title'))
            ->greeting(trans('mail.email_verification_content_1',
                ['userName' => $this->user->name]))
            ->line(trans('mail.email_verification_content_2'))
            ->action(trans('mail.email_verification_action'), $verificationUrl)
            ->line(trans('mail.email_verification_content_3', ['appName' => config('app.name')]))
            ->salutation(trans('mail.footer_salutation', ['appName' => config('app.name')]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
