<?php

declare(strict_types=1);

use App\Models\ServiceOrder;

test('to array', function (): void {
    $serviceOrder = ServiceOrder::factory()->create()->refresh();

    expect(array_keys($serviceOrder->toArray()))
        ->toBe([
            'id',
            'contract_id',
            'zone_id',
            'numero',
            'nombre_logements',
            'date_ouverture',
            'date_reception',
            'date_reversement',
            'created_at',
            'updated_at',
        ]);
});
