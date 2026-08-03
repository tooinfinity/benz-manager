<?php

declare(strict_types=1);

namespace App\Enums;

enum Technologie: string
{
    case Ftth = 'FTTH';
    case Ftto = 'FTTO';
    case Adsl = 'ADSL';
}
