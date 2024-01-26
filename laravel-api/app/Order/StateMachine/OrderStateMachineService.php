<?php

namespace App\Order\StateMachine;

use App\Order\Models\Order;
use App\Order\Services\OrderService;
use App\Order\StateMachine\Configuration\OrderStateConfiguration;
use App\Order\StateMachine\Enums\OrderStatus;
use Illuminate\Support\Facades\Log;

class OrderStateMachineService
{
    private $stateConfiguration;
    private $orderService;
    private $log;

    public function __construct(OrderStateConfiguration $stateConfiguration, OrderService $orderService, Log $log)
    {
        $this->stateConfiguration = $stateConfiguration;
        $this->orderService = $orderService;
        $this->log = $log;
    }

    public function getAllowedActions(int $orderId)
    {
        $order = Order::query()->find($orderId);
        if (!$order) {
            abort(404, 'Order not found');
        }

        $status = OrderStatus::from($order->status);

        if ($status === null) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $state = $this->stateConfiguration->stateMap()[$status->name];
        return $state->allowedActions();
    }

    public function allowedActions(int $id)
    {
        $allowedActions = $this->getAllowedActions($id);
        return response()->json(['data' => $allowedActions]);
    }

    public function processOrder(int $orderId)
    {
        $order = $this->orderService->getById($orderId);
        $collection = collect($this->getAllowedActions($orderId));
        $this->log::info( 'Processing order...');
        if ($collection->contains('value', OrderStatus::PROCESSING->value)) {
            $order->update([
                'status' => OrderStatus::PROCESSING
            ]);
        } else {
            abort(405, 'Update status not allowed!');
        }

        return $order;
    }

    public function approveOrder(int $orderId)
    {
        $order = $this->orderService->getById($orderId);
        $collection = collect($this->getAllowedActions($orderId));

        if ($collection->contains('value', OrderStatus::APPROVED->value)) {
            $order->update([
                'status' => OrderStatus::APPROVED
            ]);
        } else {
            abort(405, 'Update status not allowed!');
        }

        return $order;
    }

    public function cancelOrder(int $orderId)
    {
        $order = $this->orderService->getById($orderId);
        $collection = collect($this->getAllowedActions($orderId));

        if ($collection->contains('value', OrderStatus::CANCELED->value)) {
            $order->update([
                'status' => OrderStatus::CANCELED
            ]);
        } else {
            abort(405, 'Update status not allowed!');
        }

        return $order;
    }

    public function rejectOrder(int $orderId)
    {
        $order = $this->orderService->getById($orderId);
        $collection = collect($this->getAllowedActions($orderId));

        if ($collection->contains('value', OrderStatus::REJECTED->value)) {
            $order->update([
                'status' => OrderStatus::REJECTED
            ]);
        } else {
            abort(405, 'Update status not allowed!');
        }

        return $order;
    }
}
