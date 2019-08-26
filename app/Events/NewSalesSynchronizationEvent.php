<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewSalesSynchronizationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sales_data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sales_data)
    {
        $this->sales_data = $sales_data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('sync-channel');
    }

    public function broadcastAs()
    {
        return 'new-synchronization-event';
    }
}
