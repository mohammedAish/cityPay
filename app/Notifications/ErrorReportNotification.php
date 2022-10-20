<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ErrorReportNotification extends Notification
{
    use Queueable;
    private $subject;
    private $description;
    private $ticket_id;

    /**
     * Create a new notification instance.
     *
     * @param $subject
     * @param $description
     * @param $ticket_id
     */
    public function __construct($subject, $description, $ticket_id)
    {
        $this->subject = $subject;
        $this->description = $description;
        $this->ticket_id = $ticket_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
//            ->from('support@ctpay.uk', 'Ctpay Support')
            ->subject(cp($this->subject))
            ->line('Thanks! You created a support ticket ' . $this->ticket_id . '. Our operators are reviewing it.')
            ->line('We will reply as soon as possible.')
            ->line('Want to add information to your request?')
            ->line('Just reply to this email.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject' => $this->subject,
            'line'    => $this->description,
            'action'  => route("profile_info"),
        ];
    }
}
