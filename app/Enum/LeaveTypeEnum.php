<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum LeaveTypeEnum: string
{
    use EnumsWithOptions;

    case SICK_LEAVE = 'Sick Leave';
    case ANNUAL_LEAVE = 'Annual Leave';
    case VACATION_LEAVE = 'Vacation Leave';
    case MATERNITY_LEAVE = 'Maternity Leave';
    case PATERNITY_LEAVE = 'Paternity Leave';
    case PERSONAL_LEAVE = 'Personal Leave';
}
