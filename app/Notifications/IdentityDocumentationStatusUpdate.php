<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IdentityDocumentationStatusUpdate extends Notification
{
    use Queueable;
    private $subject;
    private $description;

    /**
     * Create a new notification instance.
     *
     * @param $subject
     * @param $description
     */
    public function __construct($subject, $description)
    {
        $this->subject = $subject;
        $this->description = $description;
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
            ->subject(cp($this->subject))
            ->line(cp($this->description))
            ->action(cp('click_to_view_details'), route('profile_info') . "#kt_Identity_Documentation_tab");
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
            'action'  => route("profile_info") . "#kt_Identity_Documentation_tab",
        ];
    }
}
