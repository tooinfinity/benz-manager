<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cite;

final readonly class DeleteCite
{
    public function handle(Cite $cite): void
    {
        $cite->delete();
    }
}
