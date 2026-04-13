<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class GarageStatus extends Enum implements LocalizedEnum
{
    const Pending =   0;
    const Ongoing =   1;
    const Finished = 2;
}
