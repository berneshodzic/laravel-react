<?php

namespace App\Containers\StateMachine\Configuration;

use App\Containers\StateMachine\Enums\ContainerStatus;
use App\Containers\StateMachine\States\ApprovedState;
use App\Containers\StateMachine\States\CanceledState;
use App\Containers\StateMachine\States\DraftState;
use App\Containers\StateMachine\States\ProcessingState;
use App\Containers\StateMachine\States\RejectedState;

class StateConfiguration
{
    private $approvedState;
    private $canceledState;
    private $draftState;
    private $processingState;
    private $rejectedState;

    public function __construct(
        ApprovedState $approvedState,
        CanceledState $canceledState,
        DraftState $draftState,
        ProcessingState $processingState,
        RejectedState $rejectedState
    ) {
        $this->approvedState = $approvedState;
        $this->canceledState = $canceledState;
        $this->draftState = $draftState;
        $this->processingState = $processingState;
        $this->rejectedState = $rejectedState;
    }

    public function stateMap()
    {
        return [
            ContainerStatus::DRAFT->name => $this->draftState,
            ContainerStatus::PROCESSING->name => $this->processingState,
            ContainerStatus::APPROVED->name => $this->approvedState,
            ContainerStatus::REJECTED->name => $this->rejectedState,
            ContainerStatus::CANCELED->name => $this->canceledState,
        ];
    }
}
