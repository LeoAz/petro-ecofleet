<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class FleetUsage extends Enum implements LocalizedEnum
{
    const Transport = 0;
    const Service = 1;
    const Autre = 2;
}
