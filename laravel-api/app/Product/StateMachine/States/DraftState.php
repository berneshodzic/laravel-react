<?php

namespace App\Product\StateMachine\States;

use App\Product\Models\Product;
use App\Product\Models\Variant;
use App\Product\Requests\InsertVariantRequest;
use App\Product\Services\ProductService;
use App\Product\Services\VariantService;
use App\Product\StateMachine\Enums\ProductActions;
use App\Product\StateMachine\Enums\ProductStatus;

class DraftState extends BaseState
{
    public function __construct(protected VariantService $variantService, protected ProductService $productService)
    {

    }

    public function allowedActions()
    {
        $actions = parent::allowedActions();
        array_push($actions, ProductActions::activate);
        return $actions;
    }

    public function insert($request)
    {
        $request['status'] = ProductStatus::DRAFT->value;
        return $this->productService->insert($request->all());
    }

    public function insertVariant(InsertVariantRequest $request)
    {
        return $this->variantService->insert($request->all());
    }

    public function activate($product)
    {
        $product->update([
            'status' => ProductStatus::ACTIVE->value
        ]);
        return $product;
    }
}
