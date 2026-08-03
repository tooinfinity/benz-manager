<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cite;

final readonly class UpdateCite
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(Cite $cite, array $attributes): void
    {
        $cite->update($attributes);
    }
}
