<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class CashboxStatus extends Enum implements LocalizedEnum
{
    const Open =   0;
    const Closed =   1;
}
