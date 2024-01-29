<?php

namespace App\Product\StateMachine;

use App\Exceptions\UserException;
use App\Product\Models\Product;
use App\Product\Services\ProductService;
use App\Product\StateMachine\Configuration\ProductStateConfiguration;
use App\Product\StateMachine\Enums\ProductStatus;
use Illuminate\Support\Facades\Auth;

class ProductStateMachineService
{
    private $productStateConfiguration;
    private $productService;
    public function __construct(ProductStateConfiguration $productStateConfiguration, ProductService $productService)
    {
        $this->productService = $productService;
        $this->productStateConfiguration = $productStateConfiguration;
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

    public function activateProduct($request, int $productId)
    {
        $user = Auth::user();
        $product = $this->productService->getById($productId);
        $collection = collect($this->getAllowedActions($productId));

        if ($collection->contains('value', ProductStatus::ACTIVE->value)) {
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

    public function deleteProduct(int $productId)
    {
        $product = $this->productService->getById($productId);
        $collection = collect($this->getAllowedActions($productId));

        if ($collection->contains('value', ProductStatus::DELETED->value)) {
            $product->update([
                'status' => ProductStatus::DELETED
            ]);
        } else {
            throw new UserException('Update status not allowed!');
        }

        return $product;
    }
}
