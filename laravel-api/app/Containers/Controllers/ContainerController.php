<?php

namespace App\Containers\Controllers;

use App\Containers\Requests\InsertContainerRequest;
use App\Containers\Resources\ContainerResource;
use App\Containers\Services\ContainerService;
use App\Containers\StateMachine\ContainerStateMachineService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function __construct(protected ContainerService $containerService, protected ContainerStateMachineService $containerStateMachineService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContainerResource::collection($this->containerService->getAllContainers());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsertContainerRequest $request)
    {
        return ContainerResource::make($this->containerService->addContainer($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ContainerResource::make($this->containerService->getById($id));
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

    public function allowedActions(int $id)
    {
        return $this->containerStateMachineService->allowedActions($id);
    }

    public function changeState(int $containerId, int $statusId)
    {
        return ContainerResource::make($this->containerStateMachineService->changeState($containerId, $statusId));
    }
}
