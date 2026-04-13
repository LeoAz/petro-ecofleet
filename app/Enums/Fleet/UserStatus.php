<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Enum;

final class UserStatus extends Enum
{
    const Active = 0;
    const Suspended = 1;
    const Blocked = 2;
}
