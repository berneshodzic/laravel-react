<?php

namespace App\Product\StateMachine\States;

use App\Product\StateMachine\Enums\ProductActions;
use App\Product\StateMachine\Enums\ProductStatus;

class ActiveState extends BaseState
{
    public function allowedActions()
    {
        $actions = parent::allowedActions();
        array_push($actions, ProductActions::delete);
        return $actions;
    }

    public function delete($product)
    {
        $product->update([
            'status' => ProductStatus::DELETED->value
        ]);
        return $product;
    }
}
