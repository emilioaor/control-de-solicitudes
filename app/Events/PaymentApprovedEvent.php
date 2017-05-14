<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentApprovedEvent extends BaseEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @param $source
     * @param $to_user
     */
    public function __construct($source, $to_user)
    {
        $this->content = 'ha aprobado pago';
        $this->route_admin = 'zone.show';
        $this->route_user = 'admin.edit';
        $this->to_user = $to_user;
        $this->source = $source;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
