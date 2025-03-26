<?php

namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum PerformanceReviewStatus: string
{
    use EnumsWithOptions;

    case UNSATISFACTORY = "Unsatisfactory";
    case NEEDS_IMPROVEMENT = "Needs Improvement";
    case MEETS_EXPECTATIONS = "Meets Expectations";
    case EXCEEDS_EXPECTATIONS = "Exceeds Expectations";
    case OUTSTANDING = "Outstanding";
}
