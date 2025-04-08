<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum RequestStatusEnum: string
{
    use EnumsWithOptions;

    case REQUESTED = 'requested';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case PENDING = 'pending';
}
