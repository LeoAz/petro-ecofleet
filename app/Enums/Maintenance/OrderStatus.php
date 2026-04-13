<?php

namespace App\Enums\Maintenance;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class OrderStatus extends Enum implements LocalizedEnum
{
    const Validated =   0;
    const Canceled =   1;
    const Received =   2;
    const Created =   3;
}
