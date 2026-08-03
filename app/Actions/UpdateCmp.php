<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cmp;

final readonly class UpdateCmp
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(Cmp $cmp, array $attributes): void
    {
        $cmp->update($attributes);
    }
}
