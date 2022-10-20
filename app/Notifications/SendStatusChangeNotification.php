<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendStatusChangeNotification extends Notification
{
    use Queueable;
    
    /**
     * @var string
     */
    private $description;
    
    /**
     * @var string
     */
    private $subject;
    
    private $stauts;

    /**
     * Create a new notification instance.
     *
     * @param $stauts
     */
    public function __construct($stauts)
    {
        $this->subject = 'order_status_changed';
        $this->description = 'order_status_changed';
        $this->stauts = $stauts;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject(cp($this->subject))
            ->line(cp('order_status_changed_desc') . ' ' . cp($this->stauts))
            ->action(cp('click_to_view_details'), route('list_deposit_withdraws') . "#deposit_requests_tab");
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
            'subject' => $this->subject,
            'line'    => $this->description,
            'action'  => route("profile_info") . "#kt_Identity_Documentation_tab",
        ];
    }
}
