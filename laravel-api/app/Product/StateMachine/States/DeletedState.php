<?php

namespace App\Product\StateMachine\States;

class DeletedState extends BaseState
{
    public function allowedActions()
    {
        $actions = parent::allowedActions();
        return $actions;
    }
}
