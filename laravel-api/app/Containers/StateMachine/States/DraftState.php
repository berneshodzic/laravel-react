<?php

namespace App\Containers\StateMachine\States;

use App\Containers\StateMachine\Enums\ContainerStatus;

class DraftState
{
    public function allowedActions()
    {
        return [
            ContainerStatus::PROCESSING,
            ContainerStatus::CANCELED
        ];
    }
}
