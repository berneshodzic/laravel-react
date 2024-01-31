<?php

namespace App\Product\StateMachine\States;

use App\Exceptions\UserException;
use App\Product\Models\Product;
use App\Product\Requests\InsertProductRequest;
use App\Product\Requests\InsertVariantRequest;
use App\Product\StateMachine\Enums\ProductStatus;

class BaseState
{
    public function __construct()
    {

    }
    public function insert(InsertProductRequest $request)
    {
        throw new UserException('Not allowed!');
    }

    public function insertVariant(InsertVariantRequest $request)
    {
        throw new UserException('Not allowed!');
    }

    public function update($request)
    {
        throw new UserException('Not allowed!');
    }
    public function activate(Product $product)
    {
        throw new UserException('Not allowed!');
    }

    public function delete(Product $product)
    {
        throw new UserException('Not allowed!');
    }

    public function createState(string $stateName): BaseState
    {
        switch ($stateName)
        {
            case ProductStatus::DRAFT->value:
                return app(DraftState::class);
            case ProductStatus::ACTIVE->value:
                return app(ActiveState::class);
            case ProductStatus::DELETED->value:
                return app(DeletedState::class);
            default:
                throw new UserException("Not supported");
         }
    }

    public function allowedActions()
    {
        return [];
    }
}
