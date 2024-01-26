<?php

namespace App\Core\SearchObject;

class BaseSearchObject
{
    public ?int $page = 1;
    public ?int $limit = 4;

    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes)
    {
        $this->page = $attributes['page'] ?? 1;
        $this->limit = $attributes['limit'] ?? 4;
    }
}
