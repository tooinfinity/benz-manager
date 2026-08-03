<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ServiceOrderSignatory;

final readonly class DeleteServiceOrderSignatory
{
    public function handle(ServiceOrderSignatory $signatory): void
    {
        $signatory->delete();
    }
}
