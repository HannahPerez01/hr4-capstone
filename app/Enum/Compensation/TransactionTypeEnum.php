<?php

namespace App\Enum\Compensation;

use App\Traits\EnumsWithOptions;

enum TransactionTypeEnum: string
{
    use EnumsWithOptions;

    case BANK = "Bank";
    case GCASH = "Gcash";
    case PAYMAYA = "Paymaya";
    case PALAWAN_EXPRESS = "Palawan Express";
}
