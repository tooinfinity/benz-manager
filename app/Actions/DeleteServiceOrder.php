<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ServiceOrder;

final readonly class DeleteServiceOrder
{
    public function handle(ServiceOrder $serviceOrder): void
    {
        $serviceOrder->delete();
    }
}
