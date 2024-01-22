<?php

namespace App\Containers\StateMachine\Configuration;

use App\Containers\StateMachine\Enums\OrderStatus;
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
            OrderStatus::DRAFT->name => $this->draftState,
            OrderStatus::PROCESSING->name => $this->processingState,
            OrderStatus::APPROVED->name => $this->approvedState,
            OrderStatus::REJECTED->name => $this->rejectedState,
            OrderStatus::CANCELED->name => $this->canceledState,
        ];
    }
}