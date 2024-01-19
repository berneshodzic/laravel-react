<?php

namespace App\Containers\Services;

use App\Containers\Models\Container;
use App\Containers\Requests\InsertContainerRequest;
use Illuminate\Validation\ValidationException;

class ContainerService
{
    public function getAllContainers()
    {
        return Container::paginate(5);
    }

    public function getById(string $id)
    {
        return Container::findOrFail($id);
    }

    public function addContainer(InsertContainerRequest $request)
    {
        try {
            $container = Container::create([
                'name' => $request->name,
                'tag' => $request->tag,
                'active' => $request->active,
                'status' => 1
            ]);

            return $container;
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);
        }
    }
}
