<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Direction;

final readonly class UpdateDirection
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(Direction $direction, array $attributes): void
    {
        $direction->update($attributes);
    }
}
