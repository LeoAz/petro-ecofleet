<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class VehicleStatus extends Enum Implements LocalizedEnum
{
    const Available = 0;
    const Garage = 1;
    const Reform = 2;
    const Travel = 3;
}

