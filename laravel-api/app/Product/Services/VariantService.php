<?php

namespace App\Product\Services;

use App\Core\Services\BaseService;
use App\Exceptions\UserException;
use App\Product\Models\Product;
use App\Product\Models\Variant;
use App\Product\Requests\InsertVariantRequest;
use App\Product\StateMachine\Enums\ProductStatus;

class VariantService extends BaseService
{
    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function insertVariant(InsertVariantRequest $request)
    {
        $product = Product::find($request['product_id']);
        if ($product->status === ProductStatus::DRAFT->value)
        {
            return $this->insert($request->all());
        }
        return throw new UserException('Product is not in DRAFT state!');
    }

    protected function getModelClass()
    {
        return Variant::class;
    }

    protected function addFilter($searchObject, $query)
    {
        return $query;
    }

    protected function includeRelation($baseSearchObject, $query)
    {
        return $query;
    }
}
