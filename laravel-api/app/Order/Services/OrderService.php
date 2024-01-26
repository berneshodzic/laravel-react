<?php

namespace App\Order\Services;

use App\Core\SearchObject\BaseSearchObject;
use App\Core\Services\BaseService;
use App\Order\Models\Order;
use App\Order\Requests\InsertOrderRequest;
use App\Order\SearchObjects\OrderSearchObject;
use App\Order\StateMachine\Enums\OrderStatus;

class OrderService extends BaseService
{
    public function insertOrder(InsertOrderRequest $request)
    {
        $data = $request->all();
        $data['status'] = OrderStatus::DRAFT;

        return parent::insert($data);
    }

    public function updateOrder(InsertOrderRequest $request)
    {

    }

    public function getSearchObject(): string
    {
        return OrderSearchObject::class;
    }

    protected function getModelClass(): string
    {
        return Order::class;
    }

    public function addFilter(OrderSearchObject | BaseSearchObject  $searchObject, $query)
    {
        if ($searchObject->status) {
            $query = $query->where('status', $searchObject->status);
        }

        return $query;
    }
}
