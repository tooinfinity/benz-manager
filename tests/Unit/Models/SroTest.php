<?php

declare(strict_types=1);

use App\Models\Sro;

test('to array', function (): void {
    $sro = Sro::factory()->create()->refresh();

    expect(array_keys($sro->toArray()))
        ->toBe([
            'id',
            'zone_id',
            'service_order_id',
            'code',
            'created_at',
            'updated_at',
        ]);
});
