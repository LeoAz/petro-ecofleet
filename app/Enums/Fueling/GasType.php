<?php

namespace App\Enums\Fueling;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class GasType extends Enum implements LocalizedEnum
{
    const Gasoil =   0;
    const Essence =   1;
}
