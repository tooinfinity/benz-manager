<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Contract;

final readonly class UpdateContract
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(Contract $contract, array $attributes): void
    {
        $contract->update($attributes);
    }
}
