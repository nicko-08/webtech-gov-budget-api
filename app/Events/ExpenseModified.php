<?php

namespace App\Events;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExpenseModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Expense $model;
    public User $user;
    public string $action;

    /**
     * Create a new event instance.
     */
    public function __construct(Expense $model, User $user, string $action)
    {
        $this->model = $model;
        $this->user = $user;
        $this->action = $action;
    }
}
