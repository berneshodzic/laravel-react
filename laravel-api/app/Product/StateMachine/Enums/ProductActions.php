<?php

namespace App\Product\StateMachine\Enums;

enum ProductActions: string
{
    case OnDraftToActive = 'OnDraftToActive';
    case OnActiveToDeleted = 'OnActiveToDeleted';
}
