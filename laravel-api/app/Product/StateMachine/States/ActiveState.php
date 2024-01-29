<?php

namespace App\Product\StateMachine\States;

use App\Product\StateMachine\Enums\ProductStatus;

class ActiveState
{
    public function allowedActions()
    {
        return [
            ProductStatus::DELETED
        ];
    }
}
