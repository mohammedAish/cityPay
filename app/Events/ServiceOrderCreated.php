<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceOrderCreated
{
    use Dispatchable,InteractsWithSockets,SerializesModels;
    public $service_type;
    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($model,$service_type){
        $this->model        = $model;
        $this->service_type = $service_type;
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
