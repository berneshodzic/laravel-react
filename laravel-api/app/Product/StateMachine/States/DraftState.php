<?php

namespace App\Product\StateMachine\States;

use App\Product\StateMachine\Enums\ProductStatus;

class DraftState
{
    public function allowedActions()
    {
        return [
            ProductStatus::ACTIVE
        ];
    }
}
