<?php

namespace App\Containers\StateMachine\States;

use App\Containers\StateMachine\Enums\ContainerStatus;

class RejectedState
{
    public function allowedActions()
    {
        return [
            ContainerStatus::PROCESSING,
        ];
    }
}
