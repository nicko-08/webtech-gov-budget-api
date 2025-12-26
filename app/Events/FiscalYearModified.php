<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FiscalYearModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Model $model;
    public ?User $user;
    public string $action;

    /**
     * Create a new event instance.
     */
    public function __construct(Model $model, ?User $user, string $action)
    {
        $this->model = $model;
        $this->user = $user;
        $this->action = $action;
    }
}
