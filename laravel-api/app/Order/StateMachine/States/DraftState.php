<?php

namespace App\Order\StateMachine\States;

use App\Order\StateMachine\Enums\OrderStatus;

class DraftState
{
    public function allowedActions()
    {
        return [
            OrderStatus::PROCESSING,
        ];
    }
}
