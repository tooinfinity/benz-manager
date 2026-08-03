<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Contract;

final readonly class DeleteContract
{
    public function handle(Contract $contract): void
    {
        $contract->delete();
    }
}
