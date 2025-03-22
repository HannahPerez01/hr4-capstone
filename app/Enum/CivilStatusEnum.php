<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum CivilStatusEnum: string
{
    use EnumsWithOptions;

    case SINGLE = "Single";
    case MARRIED = "Married";
    case DIVORCED = "Divorced";
    case SEPARATED = "Separated";
    case WIDOWED = "Widowed";
}
