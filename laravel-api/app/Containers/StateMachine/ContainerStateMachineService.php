<?php

namespace App\Containers\StateMachine;

use App\Containers\Models\Container;
use App\Containers\StateMachine\Configuration\StateConfiguration;
use App\Containers\StateMachine\Enums\ContainerStatus;

class ContainerStateMachineService
{
    private $stateConfiguration;

    public function __construct(StateConfiguration $stateConfiguration)
    {
        $this->stateConfiguration = $stateConfiguration;
    }
    public function allowedActions(int $id)
    {
        $container = Container::query()->find($id);
        if (!$container) {
            abort(404, 'Container not found');
        }

        $status = ContainerStatus::from($container->status);

        if ($status === null) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $state = $this->stateConfiguration->stateMap()[$status->name];
        $allowedActions = $state->allowedActions();

        return response()->json(['result' => $allowedActions]);
    }

    public function changeState(int $containerId, int $statusId)
    {
        $container = Container::query()->find($containerId);
        if (!$container) {
            abort(404, 'Container not found');
        }

        $status = ContainerStatus::from($container->status);

        if ($status === null) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $state = $this->stateConfiguration->stateMap()[$status->name];
        $allowedActions = $state->allowedActions();
        $collection = collect($allowedActions);

        if ($collection->contains('value', $statusId)) {
            $container->update([
                'status' => $statusId
            ]);
        } else {
            abort(405, 'Update status not allowed!');
        }

        return $container;
    }
}
