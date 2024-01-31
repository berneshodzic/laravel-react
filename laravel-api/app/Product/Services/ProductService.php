<?php

namespace App\Product\Services;

use App\Core\SearchObject\BaseSearchObject;
use App\Core\Services\BaseService;
use App\Product\Models\Product;
use App\Product\Requests\InsertVariantRequest;
use App\Product\SearchObjects\ProductSearchObject;
use App\Product\StateMachine\Enums\ProductStatus;
use App\Product\StateMachine\States\BaseState;
use Illuminate\Http\Request;

class ProductService extends BaseService
{
    public function __construct(protected BaseState $baseState)
    {

    }

    public function insertVariant(InsertVariantRequest $request)
    {
        $product = Product::find($request['product_id']);
        $state = $this->baseState->createState($product->status);

        return $state->insertVariant($request);
    }
    public function insertProduct($request)
    {
        $state = $this->baseState->createState(ProductStatus::DRAFT->value);
        return $state->insert($request);
    }

    public function getSearchObject(): string
    {
        return ProductSearchObject::class;
    }

    protected function getModelClass()
    {
        return Product::class;
    }

    protected function addFilter(BaseSearchObject|ProductSearchObject $searchObject, $query)
    {
        if ($searchObject->validFrom) {
            $query = $query->where('valid_from', '>=', $searchObject->validFrom);
        }

        if ($searchObject->validTo) {
            $query = $query->where('valid_to', '<=', $searchObject->validTo);
        }

        if ($searchObject->priceGTE || $searchObject->priceLTE) {
            $query =
                $query->with('Variant', function ($variantQuery) use ($searchObject) {
                    if ($searchObject->priceGTE) {
                        $variantQuery->where('price', '>=', $searchObject->priceGTE);
                    }
                    if ($searchObject->priceLTE) {
                        $variantQuery->where('price', '<', $searchObject->priceLTE);
                    }
                })->
                whereHas('Variant', function ($variantQuery) use ($searchObject) {
                    if ($searchObject->priceGTE) {
                        $variantQuery->where('price', '>=', $searchObject->priceGTE);
                    }
                    if ($searchObject->priceLTE) {
                        $variantQuery->where('price', '<', $searchObject->priceLTE);
                    }
                });

        }

        return $query;
    }

    protected function includeRelation(BaseSearchObject|ProductSearchObject $searchObject, $query)
    {
        if ($searchObject->includeProductType) {
            $query = $query->with('ProductType');
        }

        if ($searchObject->includeVariants) {
            $query = $query->with('Variant');
        }

        return $query;
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');
        return Product::where('name', 'ILIKE', "%$query%")->get();
    }

    public function allowedActions(int $id)
    {
        $product = Product::find($id);
        $state = $this->baseState->createState($product->status);

        return $state->allowedActions();
    }

    public function activateProduct($request, $id)
    {
        $product = Product::find($id);
        $state = $this->baseState->createState($product->status);

        return $state->activate($product);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $state = $this->baseState->createState($product->status);

        return $state->delete($product);
    }
}
