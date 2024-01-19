<?php

namespace App\Containers\StateMachine\Enums;

enum ContainerStatus: int
{
    case DRAFT = 1;
    case PROCESSING = 2;
    case APPROVED = 3;
    case REJECTED = 4;
    case CANCELED = 5;
}
