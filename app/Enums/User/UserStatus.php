<?php

namespace App\Enums\User;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;


final class UserStatus extends Enum implements LocalizedEnum
{
    const Active = 0;
    const Desactivate = 1;
}
