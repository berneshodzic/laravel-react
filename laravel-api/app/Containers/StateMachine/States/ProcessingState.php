<?php

namespace App\Containers\StateMachine\States;

use App\Containers\StateMachine\Enums\ContainerStatus;

class ProcessingState
{
    public function allowedActions()
    {
        return [
            ContainerStatus::APPROVED,
            ContainerStatus::REJECTED,
            ContainerStatus::CANCELED
        ];
    }
}
