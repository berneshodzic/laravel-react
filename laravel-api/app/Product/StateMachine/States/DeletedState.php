<?php

namespace App\Product\StateMachine\States;

use App\Product\StateMachine\Enums\ProductActions;

class DeletedState
{
    public function allowedActions()
    {
        return [

        ];
    }
}
