<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class TrailerType extends Enum implements LocalizedEnum
{
    const Citerne =   0;
    const Benne =   1;
    const Frigorifique = 2;
    const Ampliroll = 3;
    const Plateau = 4;
    const Porte_Char = 5;
    const Autre = 6;
}
