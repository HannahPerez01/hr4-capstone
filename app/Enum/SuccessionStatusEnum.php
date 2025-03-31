<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum SuccessionStatusEnum: string
{
    use EnumsWithOptions;

    case ACTIVE = "Active";
    case IN_PROGRESS = "In Progress";
    case READY_NOW = "Ready Now";
    case NOT_READY = "Not Ready";
}

