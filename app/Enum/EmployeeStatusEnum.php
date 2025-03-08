<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum EmployeeStatusEnum: string
{
    use EnumsWithOptions;

    case ACTIVE = "Active";
    case ON_LEAVE = "On-leave";
    case TERMINATED = "Terminated";
}
