<?php

namespace App\Order\StateMachine\States;

use App\Order\StateMachine\Enums\OrderStatus;

class ProcessingState
{
    public function allowedActions()
    {
        return [
            OrderStatus::APPROVED,
            OrderStatus::REJECTED,
            OrderStatus::CANCELED
        ];
    }
}
