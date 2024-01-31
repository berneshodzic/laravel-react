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
