<?php

namespace App\Events;

use App\Models\GovernmentUnit;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GovernmentUnitModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public GovernmentUnit $model,
        public ?User $user,
        public string $action
    ) {}
}
