<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Enum;

final class RepairStatus extends Enum
{
    const Closed =   0;
    const Pending =   1;
}
