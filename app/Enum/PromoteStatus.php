<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum PromoteStatus: string
{
    use EnumsWithOptions;

    case PROMOTED = "Promoted";
    case REJECTED = "Rejected";
}
