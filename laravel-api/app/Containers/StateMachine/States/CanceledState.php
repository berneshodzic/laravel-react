<?php

namespace App\Containers\StateMachine\States;

use App\Containers\StateMachine\Enums\ContainerStatus;

class CanceledState
{
    public function allowedActions()
    {
        return [
            ContainerStatus::PROCESSING,
            ContainerStatus::CANCELED
        ];
    }
}
