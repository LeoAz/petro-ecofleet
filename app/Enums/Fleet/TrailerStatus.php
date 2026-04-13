<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class TrailerStatus extends Enum implements LocalizedEnum
{
    const Available = 0;
    const Reform = 1;
    const Garage = 2;
    const Linked = 3;
}
