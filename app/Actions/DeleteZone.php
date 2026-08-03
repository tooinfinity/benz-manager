<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Zone;

final readonly class DeleteZone
{
    public function handle(Zone $zone): void
    {
        $zone->delete();
    }
}
