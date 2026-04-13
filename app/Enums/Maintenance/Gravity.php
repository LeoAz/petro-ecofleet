<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class Gravity extends Enum implements LocalizedEnum
{
    const Low =   0;
    const High =   1;
    const Critical = 2;
}
