<?php

namespace App\Events;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BudgetModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Budget $model;
    public User $user;
    public string $action;

    /**
     * Create a new event instance.
     */
    public function __construct(Budget $model, User $user, string $action)
    {
        $this->model = $model;
        $this->user = $user;
        $this->action = $action;
    }
}
