<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum DepartmentEnum: string
{
    use EnumsWithOptions;

    case HR = "HR";
    case LOGISTICS = "Logistics";
    case FINANCE = "Finance";
    case TRAINING = "Training";
    case SECURITY = "Security";
}
