<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Sro;

final readonly class UpdateSro
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(Sro $sro, array $attributes): void
    {
        $sro->update($attributes);
    }
}
