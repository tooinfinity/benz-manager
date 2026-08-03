<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Direction;

final readonly class DeleteDirection
{
    public function handle(Direction $direction): void
    {
        $direction->delete();
    }
}
