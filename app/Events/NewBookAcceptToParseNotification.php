<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewBookAcceptToParseNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $isbn;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($isbn)
    {
        //
        $this->isbn=$isbn;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('andrey.1');
        //return ['andrey.1'];
    }

    public function broadcastAs()
    {
        return 'parser.book.accepted';
    }

    public function broadcastWith()
    {
        return $this->isbn;
    }
}
