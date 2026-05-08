<?php

namespace App\Enums\Fueling;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class FuelOrderStatus extends Enum implements LocalizedEnum
{
    const Unpaid =   0;
    const Paid =   1;
}
