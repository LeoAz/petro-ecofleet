<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class PartState extends Enum implements LocalizedEnum
{
    const InStock =   0;
    const OutOfStock =   1;
}
