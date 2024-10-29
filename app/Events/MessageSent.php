<?php

namespace App\Events;

use App\Models\Messages;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $threadID;
    public $message;
    public $senderID;
    public $created_at;
    public $receiverID;
    public $lastname;
    public $firstname;
    /**
     * Create a new event instance.
     */
    public function __construct($message, $senderID, $threadID, $created_at, $receiverID, $firstname, $lastname)
    {
        Log::info('Sent');
        Log::info($message);
        Log::info($senderID);
        Log::info($threadID);
        Log::info($created_at);
        Log::info($receiverID);
        $this->message = $message;
        $this->senderID = $senderID;
        $this->threadID = $threadID;
        $this->created_at = $created_at;
        $this->receiverID = $receiverID;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        Log::info('Broadcast on');
        Log::info($this->receiverID);
        return new PrivateChannel('chat.' . $this->receiverID);
    }

    public function broadcastWith()
    {
        Log::info('Broadcast with');
        Log::info($this->threadID);
        Log::info($this->message);
        Log::info($this->senderID);
        Log::info($this->created_at);
        return [
            'threadID' => $this->threadID,
            'message' => $this->message,
            'senderID' => $this->senderID,
            'created_at' => $this->created_at,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname
        ];
    }
}
