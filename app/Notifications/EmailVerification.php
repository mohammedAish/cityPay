<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/*
 * @deprecated
 */
class EmailVerification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $entity;
    protected $entityRef;

    public function __construct($entity, $entityRef) {
        $this->entity    = $entity;
        $this->entityRef = $entityRef;
    }

    public function via($notifiable) {
        if (!isset($this->entityRef['name'])) {
            return false;
        }
        return ['mail'];
    }

    public function toMail($notifiable) {
        $verificationUrl = url('verify/customer/email/'.$this->entity->email_token);
        return (new MailMessage)
            ->subject(trans('mail.email_verification_title'))
            ->greeting(trans('mail.email_verification_content_1',
                ['userName' => $this->entity->{$this->entityRef['name']},]))
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
