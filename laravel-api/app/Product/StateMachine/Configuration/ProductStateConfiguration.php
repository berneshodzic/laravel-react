<?php

namespace App\Product\StateMachine\Configuration;

use App\Product\StateMachine\Enums\ProductStatus;
use App\Product\StateMachine\States\ActiveState;
use App\Product\StateMachine\States\DeletedState;
use App\Product\StateMachine\States\DraftState;

class ProductStateConfiguration
{
    private $draftState;
    private $activeState;
    private $deletedState;

    public function __construct(
        ActiveState   $activeState,
        DeletedState   $deletedState,
        DraftState      $draftState,
    )
    {
        $this->activeState = $activeState;
        $this->deletedState = $deletedState;
        $this->draftState = $draftState;
    }

    public function stateMap()
    {
        return [
            ProductStatus::DRAFT->name => $this->draftState,
            ProductStatus::ACTIVE->name => $this->activeState,
            ProductStatus::DELETED->name => $this->deletedState,
        ];
    }
}
