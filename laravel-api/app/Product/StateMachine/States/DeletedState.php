<?php

namespace App\Product\StateMachine\States;

use App\Product\StateMachine\Enums\ProductActions;

class DeletedState extends BaseState
{
    public function allowedActions()
    {
        $actions = parent::allowedActions();
        return $actions;
    }
}
