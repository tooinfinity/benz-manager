<?php

declare(strict_types=1);

use App\Models\ServiceOrderSignatory;

test('to array', function (): void {
    $signatory = ServiceOrderSignatory::factory()->create()->refresh();

    expect(array_keys($signatory->toArray()))
        ->toBe([
            'id',
            'service_order_id',
            'role',
            'name',
            'created_at',
            'updated_at',
        ]);
});
