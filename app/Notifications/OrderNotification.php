<?php

namespace App\Notifications;

use App\Models\DepositOrder;
use App\Models\EmailTemplate;
use App\Notifications\Traits\HasParams;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * this notification will used for all order types (deposit,withdrawul)
 * @property DepositOrder $deposit_order
 * Class DepositNotification
 * @package App\Notifications
 */
class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable, HasParams;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $deposit_order;
    /**
     * @var string
     */
    private $subject;
    private $description;

    public function __construct(DepositOrder $deposit_order, $subject = '', $description = '')
    {
        $this->deposit_order = $deposit_order;

        if ($subject != ''){
            $mail_subject = $subject;
        }else{
            $mail_subject = cp('order_notification_subject');
        }

        if ($description != ''){
            $mail_description = $description;
        }else{
            $mail_description = cp('order_notification_description');
        }

        $this->subject = $mail_subject;
        $this->description = $mail_description;
        
//        $this->delay(2);
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
     * @return MailMessage|bool
     */
    public function toMail($notifiable)
    {
//        $params = $this->getEmailParams($notifiable);
//
//        if (!$params) {
//            return false;
//        }

        return (new MailMessage)
            ->subject($this->subject)
            ->line($this->description)
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
            'subject' => $this->subject,
            'line'    => $this->description,
            'action'  => route("list_deposit_withdraws") . "#all_processes_tab",
        ];
    }
}
