<?php

namespace App\Product\StateMachine\Enums;

enum ProductActions: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case DELETED = 'deleted';
}
