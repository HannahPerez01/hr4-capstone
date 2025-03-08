<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum EmploymentTypeEnum: string
{
    use EnumsWithOptions;

    case FULL_TIME = "Full Time";
    case PART_TIME = "Part Time";
}
