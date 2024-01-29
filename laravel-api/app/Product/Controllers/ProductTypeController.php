<?php

namespace App\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Product\Models\ProductType;
use App\Product\Requests\InsertProductTypeRequest;
use App\Product\Resources\ProductTypeResource;
use App\Product\Services\ProductTypeService;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function __construct(protected ProductTypeService $productTypeService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductTypeResource::collection($this->productTypeService->getPageable());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsertProductTypeRequest $request)
    {
        return ProductTypeResource::make($this->productTypeService->insert($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return ProductTypeResource::make($this->productTypeService->getById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}
