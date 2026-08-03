<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Zone;

final readonly class UpdateZone
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(Zone $zone, array $attributes): void
    {
        $zone->update($attributes);
    }
}
