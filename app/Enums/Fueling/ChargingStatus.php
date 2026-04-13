<?php

namespace App\Enums\Fueling;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ChargingStatus extends Enum implements LocalizedEnum
{
    const Unbilled =   0;
    const Billed =   1;
}
