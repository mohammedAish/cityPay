<?php

namespace App\Notifications;

use App\Models\DepositOrder;
use App\Models\EmailTemplate;
use App\Notifications\Traits\OrderTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositNotification extends Notification implements ShouldQueue
{
    use Queueable, OrderTrait;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $deposit_order;

    public function __construct(DepositOrder $deposit_order) {
        $this->deposit_order = $deposit_order;
        $this->delay(5);
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
        $params = $this->getEmailParams($this->deposit_order->op_type, $this->deposit_order->current_status);
        /*if ($this->deposit_order->current_status == 'confirmed') {
            $params = $this->getEmailParams('deposit', 'ACCEPT_DEPOSIT');
        } elseif ($this->deposit_order->current_status == 'rejected') {
            $params = $this->getEmailParams('withdraw', 'REJECT_WITHDRAW');
        }*/
        if (!$params) {
            return;
        }

        return (new MailMessage)
            ->line($params->subject)
            ->action('click here ', url($params->action))
            ->line($params->email_body);
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
