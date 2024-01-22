<?php

namespace App\Order\Services;

use App\Order\Models\Order;
use App\Order\Requests\InsertOrderRequest;
use App\Order\StateMachine\Enums\OrderStatus;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function getAll()
    {
        return Order::paginate(5);
    }

    public function getById(string $id)
    {
        return Order::findOrFail($id);
    }

    public function insertOrder(InsertOrderRequest $request)
    {
        try {
            $order = Order::create([
                'description' => $request->description,
                'amount' => $request->amount,
                'status' => OrderStatus::DRAFT
            ]);

            return $order;
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);
        }
    }
}
