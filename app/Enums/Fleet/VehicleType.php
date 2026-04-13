<?php

namespace App\Enums\Fleet;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class VehicleType extends Enum implements LocalizedEnum
{
    const Tracteur = 0;
    const Utilitaire = 1;
    const Bus = 2;
    const Camion_Benne = 2;
    const Camion_Frigorifique = 3;
    const Suv = 4;
    const Fourgonnette = 5;
    const Berline = 6;
    const Pick_Up = 7;
    const Fourgon = 8;
    const Autre = 9;
}
