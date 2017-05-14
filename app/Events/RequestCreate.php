<?php

namespace App\Events;

use Faker\Provider\Base;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Auth;

class RequestCreate extends BaseEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @param null $source
     */
    public function __construct($source)
    {
        $this->content = 'ha registrado solicitud';
        $this->route_admin = 'admin.edit';
        $this->route_user = 'zone.show';
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
