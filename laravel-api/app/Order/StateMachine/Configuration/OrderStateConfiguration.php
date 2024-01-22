<?php

namespace App\Order\StateMachine\Configuration;

use App\Order\StateMachine\States\ApprovedState;
use App\Order\StateMachine\States\CanceledState;
use App\Order\StateMachine\States\DraftState;
use App\Order\StateMachine\States\ProcessingState;
use App\Order\StateMachine\States\RejectedState;
use App\Order\StateMachine\Enums\OrderStatus;

class OrderStateConfiguration
{
    private $approvedState;
    private $canceledState;
    private $draftState;
    private $processingState;
    private $rejectedState;

    public function __construct(
        ApprovedState   $approvedState,
        CanceledState   $canceledState,
        DraftState      $draftState,
        ProcessingState $processingState,
        RejectedState   $rejectedState
    )
    {
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
