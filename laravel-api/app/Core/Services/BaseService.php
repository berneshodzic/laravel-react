<?php

namespace App\Core\Services;

use App\Core\SearchObject\BaseSearchObject;
use App\Exceptions\ModelNotFoundException;

abstract class BaseService
{
    abstract protected function getModelClass();
    abstract protected function addFilter(BaseSearchObject $baseSearchObject, $query);
    public function getAll()
    {
        $searchObjectInstance = app($this->getSearchObject());

        $query = app($this->getModelClass())->query();

        $searchObjectInstance->fill(request()->query());

        $query = $this->addFilter($searchObjectInstance, $query);

        return $query->paginate($searchObjectInstance->limit);
    }

    public function getById($id)
    {
        $model = $this->getModelClass()::find($id);
        if (!$model) {
            throw new ModelNotFoundException('Model not found!');
        }
        return $model;
    }

    public function insert($request)
    {
        return $this->getModelClass()::create($request);
    }

    public function update($request, $id)
    {
        $model = $this->getById($id);
        return $model->update($request->all());
    }

    public function delete($id)
    {
        $model = $this->getModelClass();
        return $model::destroy($id);
    }

    public function getSearchObject(): string
    {
        return BaseSearchObject::class;
    }
}
