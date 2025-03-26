<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum JobRequestStatusEnum: string
{
    use EnumsWithOptions;

    CASE PENDING = "Pending";
    CASE IN_PROGRESS = "In progress";
    CASE COMPLETED = "Completed";
}
