<?php

namespace App\Order\StateMachine\Enums;

enum OrderStatus: string
{
    case DRAFT = 'draft';
    case PROCESSING = 'processing';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case CANCELED = 'canceled';
}
