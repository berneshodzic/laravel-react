<?php

namespace App\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Product\Models\Variant;
use App\Product\Requests\InsertVariantRequest;
use App\Product\Resources\VariantResource;
use App\Product\Services\VariantService;
use App\Product\StateMachine\ProductStateMachineService;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function __construct(protected VariantService $variantService, protected ProductStateMachineService $productStateMachineService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsertVariantRequest $request)
    {
        return VariantResource::make($this->productStateMachineService->onInsertToDraft($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return VariantResource::make($this->variantService->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->variantService->delete($id);
    }
}
