<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class OpType extends Enum implements LocalizedEnum
{
    const CashIn =   0;
    const CashOut =   1;
}
