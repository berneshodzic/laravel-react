<?php

namespace App\Product\Services;

use App\Core\SearchObject\BaseSearchObject;
use App\Core\Services\BaseService;
use App\Product\Models\ProductType;

class ProductTypeService extends BaseService
{

    protected function getModelClass()
    {
        return ProductType::class;
    }

    protected function addFilter(BaseSearchObject $baseSearchObject, $query)
    {
        return $query;
    }

    protected function includeRelation(BaseSearchObject $baseSearchObject, $query)
    {
        return $query;
    }


}
