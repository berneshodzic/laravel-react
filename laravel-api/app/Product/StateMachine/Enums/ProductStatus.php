<?php

namespace App\Product\StateMachine\Enums;

enum ProductStatus: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case DELETED = 'deleted';
}
