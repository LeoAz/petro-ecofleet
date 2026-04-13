<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;


final class ExitVoucherState extends Enum implements LocalizedEnum
{
    const Used =   0;
    const Unused =   1;
}
