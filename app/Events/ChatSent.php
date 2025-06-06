<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat;

class ChatSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;
    /**
     * Create a new event instance.
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->chat->room_id)
        ];
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chat->id,
            'user_id' => $this->chat->user_id,
            'pesan' => $this->chat->pesan,
            'created_at' => $this->chat->created_at->toDateTimeString(),
        ];
    }
}
