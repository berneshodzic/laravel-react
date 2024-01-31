<?php

namespace App\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Product\Models\Product;
use App\Product\Requests\ActivateProductRequest;
use App\Product\Requests\InsertProductRequest;
use App\Product\Requests\InsertVariantRequest;
use App\Product\Resources\ProductResource;
use App\Product\Resources\VariantResource;
use App\Product\Services\ProductService;
use App\Product\StateMachine\ProductStateMachineService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService, protected ProductStateMachineService $productStateMachineService)
    {

    }

    /**
     * @OA\Info(
     *     title="Swagger",
     *     description="Product API",
     *     version="1.0.0",
     *  )
     * @OA\Get(
         * path="/api/product",
         * summary="Get all products",
         * tags={"Product"},
         *   @OA\Parameter(
         *       name="validFrom",
         *       in="query",
         *       required=false,
         *       description="ValidFrom Product",
         *       @OA\Schema(
         *          type="DateTime",
         *       ),
         *   ),
         *     @OA\Parameter(
         *        name="validTo",
         *        in="query",
         *        required=false,
         *        description="ValidTo Product",
         *        @OA\Schema(
         *           type="DateTime",
         *        ),
         *    ),
         *          @OA\Parameter(
         *         name="includeVariants",
         *         in="query",
         *         required=false,
         *         description="Include product variants",
         *         @OA\Schema(
         *            type="Boolean",
         *         ),
         *     ),
         *               @OA\Parameter(
         *          name="includeProductType",
         *          in="query",
         *          required=false,
         *          description="Include product type",
         *          @OA\Schema(
         *             type="Boolean",
         *          ),
         *      ),
         * @OA\Response(
             * response=200,
             * description="Successful operation",
         * ),
     * )
     */


    public function index()
    {
        return ProductResource::collection($this->productService->getPageable());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsertProductRequest $request)
    {
        return ProductResource::make($this->productService->insertProduct($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return ProductResource::make($this->productService->getById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return ProductResource::make($this->productService->update($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->productService->delete($id);
    }

    public function allowedActions(int $productId)
    {
        return response()->json($this->productService->allowedActions($productId));
    }

    public function insertVariant(InsertVariantRequest $request)
    {
        return VariantResource::make($this->productService->insertVariant($request));
    }

    public function OnDraftToActive(ActivateProductRequest $request, $id)
    {
        return ProductResource::make($this->productService->OnDraftToActive($request, $id));
    }

    public function OnActiveToDeleted($id)
    {
        return ProductResource::make($this->productService->OnActiveToDeleted($id));
    }

    public function search(Request $request)
    {
        return ProductResource::collection($this->productService->searchProduct($request));
    }
}
