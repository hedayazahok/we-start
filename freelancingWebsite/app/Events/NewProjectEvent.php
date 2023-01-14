<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NewProjectEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $project;

    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        $this->project = $project;
        $this->message  = " <i class='fas fa-envelope></i>new project created : '{$project->title} ' ";

    }
    public function broadcastAs()
    {
        return 'new-project';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $id=User::where('type','admin')->id();
        return ['new-project.'.$id];
    }
}
