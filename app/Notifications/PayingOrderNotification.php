<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayingOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    private $subject;
    private $description;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(cp('paying_order_notification_subject'))
            ->line(cp('paying_order_notification_content'))
            ->action(cp('click_to_view_details'), route('list_deposit_orders'));
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
            'subject' => 'paying_order_notification_subject',
            'line'    => 'paying_order_notification_content',
            'action'  => route("list_deposit_withdraws") . "#pay_bills_requests_tab",
        ];
    }
}
