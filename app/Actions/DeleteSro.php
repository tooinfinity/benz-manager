<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Sro;

final readonly class DeleteSro
{
    public function handle(Sro $sro): void
    {
        $sro->delete();
    }
}
