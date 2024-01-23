<?php

namespace App\Order\Controllers;

use App\Http\Controllers\Controller;
use App\Order\Requests\InsertOrderRequest;
use App\Order\Resources\OrderResource;
use App\Order\Services\OrderService;
use App\Order\StateMachine\OrderStateMachineService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService, protected OrderStateMachineService $orderStateMachineService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection($this->orderService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsertOrderRequest $request)
    {
        return OrderResource::make($this->orderService->insertOrder($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return OrderResource::make($this->orderService->getById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function allowedActions(int $orderId)
    {
        return $this->orderStateMachineService->allowedActions($orderId);
    }

    public function processOrder(int $orderId)
    {
        return OrderResource::make($this->orderStateMachineService->processOrder($orderId));
    }

    public function approveOrder(int $orderId)
    {
        return OrderResource::make($this->orderStateMachineService->approveOrder($orderId));
    }

    public function rejectOrder(int $orderId)
    {
        return OrderResource::make($this->orderStateMachineService->rejectOrder($orderId));
    }

    public function cancelOrder(int $orderId)
    {
        return OrderResource::make($this->orderStateMachineService->cancelOrder($orderId));
    }
}
