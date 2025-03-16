<?php

namespace App\Enum\Compensation;

use App\Traits\EnumsWithOptions;

enum JobCategoryEnum: string
{
    use EnumsWithOptions;

    case HR_STAFF = "HR Staff";
    case SECURITY_AGENCY = "Security Agency";
    case LOGISTIC_STAFF = "Logistic Staff";
    case FINANCE_STAFF = "Finance Staff";
    case TRAINING_STAFF = "Training Staff";
}
