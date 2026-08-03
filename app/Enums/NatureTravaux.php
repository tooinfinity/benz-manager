<?php

declare(strict_types=1);

namespace App\Enums;

enum NatureTravaux: string
{
    case Developpement = 'Developpement';
    case Extension = 'Extension';
    case Maintenance = 'Maintenance';
    case Raccordement = 'Raccordement';
}
