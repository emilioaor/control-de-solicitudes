<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentRegister extends BaseEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @param $source
     */
    public function __construct($source)
    {
        $this->content = 'ha registrado pago';
        $this->route_admin = 'zone.show';
        $this->route_user = 'admin.edit';
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
