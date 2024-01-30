<?php

namespace App\Product\StateMachine;

use App\Exceptions\UserException;
use App\Product\Models\Product;
use App\Product\Services\ProductService;
use App\Product\Services\VariantService;
use App\Product\StateMachine\Configuration\ProductStateConfiguration;
use App\Product\StateMachine\Enums\ProductStatus;
use Illuminate\Support\Facades\Auth;

class ProductStateMachineService
{
    private $productStateConfiguration;
    private $variantService;
    public function __construct(ProductStateConfiguration $productStateConfiguration, VariantService $variantService)
    {
        $this->productStateConfiguration = $productStateConfiguration;
        $this->variantService = $variantService;
    }

    public function getAllowedActions(int $productId)
    {
        $product = Product::query()->find($productId);
        if (!$product) {
            throw new UserException('Product not found!');
        }

        $status = ProductStatus::from($product->status);

        if ($status === null) {
            throw new UserException('Wrong status');
        }

        $state = $this->productStateConfiguration->stateMap()[$status->name];
        return $state->allowedActions();
    }

    public function allowedActions(int $id)
    {
        return $this->getAllowedActions($id);
    }

    public function onInsertToDraft($request)
    {
        $product = Product::find($request['product_id']);
        if ($product->status === ProductStatus::DRAFT->value)
        {
            return $this->variantService->insertVariant($request);
        } else throw new UserException("Product is not in DRAFT state!");
    }

    public function OnDraftToActive($request, int $productId)
    {
        $user = Auth::user();
        $product = Product::find($productId);
        $collection = collect($this->getAllowedActions($productId));

        if ($collection->contains('value', 'OnDraftToActive')) {
            $product->update([
                'status' => ProductStatus::ACTIVE,
                'activatedBy' => $user->email,
                'valid_from' => $request['valid_from'],
                'valid_to' => $request['valid_to']
            ]);
        } else {
            throw new UserException('Activate status not allowed!');
        }

        return $product;
    }

    public function OnActiveToDeleted(int $productId)
    {
        $product = Product::find($productId);
        $collection = collect($this->getAllowedActions($productId));

        if ($collection->contains('value', 'OnActiveToDeleted')) {
            $product->update([
                'status' => ProductStatus::DELETED
            ]);
        } else {
            throw new UserException('Delete status not allowed!');
        }

        return $product;
    }
}
