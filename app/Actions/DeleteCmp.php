<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cmp;

final readonly class DeleteCmp
{
    public function handle(Cmp $cmp): void
    {
        $cmp->delete();
    }
}
