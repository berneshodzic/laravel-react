<?php

namespace App\Product\Services;

use App\Core\SearchObject\BaseSearchObject;
use App\Core\Services\BaseService;
use App\Product\Models\ProductType;
use Illuminate\Support\Facades\Cache;

class ProductTypeService extends BaseService
{
    public function getPageable()
    {
        if (Cache::has('product_type')) {
            $productTypes = Cache::get('product_type');
        } else {
            $productTypes = parent::getPageable();
            Cache::put('product_type', $productTypes, now()->addMinutes(1));
            return $productTypes;
        }
        return $productTypes;
    }

    public function getById($id)
    {
        Cache::forget('product_type');
        return parent::getById($id);
    }
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
