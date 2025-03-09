<?php

namespace App\Enum\Compensation;

use App\Traits\EnumsWithOptions;

enum StatusEnum: string
{
    use EnumsWithOptions;

    case RECEIVED = "Received";
    case PENDING = "Pending";
}
