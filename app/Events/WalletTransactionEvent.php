<?php

namespace App\Events;

use Bavix\Wallet\Models\Transaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WalletTransactionEvent implements ShouldQueue
{
    use Dispatchable,InteractsWithSockets,SerializesModels;
    public $transaction;
    public $reference_type;
    public $reference_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction,$reference_type,$reference_id){
        $this->transaction    = $transaction;
        $this->reference_type = $reference_type;
        $this->reference_id   = $reference_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(){
        return new PrivateChannel('channel-name');
    }
}
