<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum EmployeeGenderEnum: string
{
    use EnumsWithOptions;

    case MALE = "Male";
    case FEMALE = "Female";
    case OTHERS = "Others";
}
