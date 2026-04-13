<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ExitVoucherStatus extends Enum implements LocalizedEnum
{
    const Opened =   0;
    const Validated =   1;
}
