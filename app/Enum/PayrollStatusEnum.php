<?php
namespace App\Enum;

use App\Traits\EnumsWithOptions;

enum PayrollStatusEnum: string {

    case NOT_STARTED = "Not Started";
    case IN_PROGRESS = "In Progress";
    case COMPLETED   = "Completed";
}
