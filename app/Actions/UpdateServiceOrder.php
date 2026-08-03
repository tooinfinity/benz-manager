<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ServiceOrder;

final readonly class UpdateServiceOrder
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(ServiceOrder $serviceOrder, array $attributes): void
    {
        $serviceOrder->update($attributes);
    }
}
