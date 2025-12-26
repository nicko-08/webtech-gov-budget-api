<?php

namespace App\Events;

use App\Models\BudgetItem;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BudgetItemModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public BudgetItem $model;
    public User $user;
    public string $action;

    /**
     * Create a new event instance.
     */
    public function __construct(BudgetItem $model, User $user, string $action)
    {
        $this->model = $model;
        $this->user = $user;
        $this->action = $action;
    }
}
