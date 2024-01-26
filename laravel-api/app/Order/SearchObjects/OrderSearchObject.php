<?php

namespace App\Order\SearchObjects;

use App\Core\SearchObject\BaseSearchObject;

class OrderSearchObject extends BaseSearchObject
{
    public ?string $status;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    public function fill(array $attributes)
    {
        parent::fill($attributes);
        $this->status = $attributes['status'] ?? null;
    }
}
