<?php

namespace App\Product\StateMachine\Enums;

enum ProductActions: string
{
    case activate = 'activate';
    case delete = 'delete';
}
