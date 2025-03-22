<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum UserRoleEnum: string
{
    use EnumsWithOptions;

    case SUPER_ADMIN = 'super_admin';
    case EMPLOYEE = 'employee';
    case HR_ASSISTANT = 'hr_assistant';
    case HR_SPECIALIST = 'hr_specialist';
    case HR_COORDINATOR = 'hr_coordinator';
    case HR_MANAGER = 'hr_manager';
    case HR_DIRECTOR = 'hr_director';
}
