<?php

declare(strict_types=1);

namespace App\Enums;

enum SignatoryRole: string
{
    case Direction_operational = 'DO';
    case Cil = 'CIL';
    case Cmp = 'CMP';
    case Surveillant_chantier = 'Surveillant_chantier';
    case Prestataire = 'Prestataire';
    case Magasin = 'Magasin';
}
