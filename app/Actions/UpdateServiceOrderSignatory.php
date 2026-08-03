<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ServiceOrderSignatory;

final readonly class UpdateServiceOrderSignatory
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(ServiceOrderSignatory $signatory, array $attributes): void
    {
        $signatory->update($attributes);
    }
}
