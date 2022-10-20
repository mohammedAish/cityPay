<?php

namespace App\Notifications;

use App\Models\DepositOrder;
use App\Notifications\Traits\HasParams;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * @property DepositOrder $deposit_order
 * Class WithdrawNotification
 * @package App\Notifications
 */
class WithdrawNotification extends Notification implements ShouldQueue
{
    use Queueable, HasParams;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $deposit_order;

    public function __construct(DepositOrder $deposit_order) {
        $this->deposit_order = $deposit_order;
        $this->delay(4);
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

        try {
            $params = $this->getEmailParams();

            if ($params == null) {
                return;
            }
            return (new MailMessage)
                ->line($params->subject)
                ->action('اضغط هنا للاستعراض ', url($params->action))
                ->line($params->email_body);
        } catch (\Exception $ex) {

        }
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
