<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class PurchaseStatus extends Enum implements LocalizedEnum
{
    const Pending =   0;
    const Validated =   1;
}
