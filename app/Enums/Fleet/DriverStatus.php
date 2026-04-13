<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class DriverStatus extends Enum implements LocalizedEnum
{
    const Assign =   0;
    const Unassign =   1;
}
