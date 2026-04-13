<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class InventoryStatus extends Enum implements LocalizedEnum
{
    const Open =   0;
    const Closed =   1;
}
