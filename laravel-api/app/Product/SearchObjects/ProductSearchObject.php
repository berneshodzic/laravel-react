<?php

namespace App\Product\SearchObjects;

use App\Core\SearchObject\BaseSearchObject;
use DateTime;

class ProductSearchObject extends BaseSearchObject
{
    public ?string $name = null;
    public ?bool $includeProductType = false;
    public ?bool $includeVariants = false;
    public ?float $priceLTE = null;
    public ?float $priceGTE = null;
    public ?DateTime $validFrom = null;
    public ?DateTime $validTo = null;
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    public function fill(array $attributes)
    {
        parent::fill($attributes);
        $this->includeProductType = $attributes['includeProductType'] ?? false;
        $this->includeVariants = $attributes['includeVariants'] ?? false;
        $this->validFrom = isset($attributes['validFrom']) ? new DateTime($attributes['validFrom']) : null;
        $this->validTo = isset($attributes['validTo']) ? new DateTime($attributes['validTo']) : null;
        $this->priceLTE = $attributes['priceLTE'] ?? null;
        $this->priceGTE = $attributes['priceGTE'] ?? null;
        $this->name = $attributes['name'] ?? null;
    }
}
