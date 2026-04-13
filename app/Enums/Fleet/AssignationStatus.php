<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class AssignationStatus extends Enum implements LocalizedEnum
{
    const Active =   0;
    const Revoked =   1;
}
