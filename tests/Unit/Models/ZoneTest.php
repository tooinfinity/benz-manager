<?php

declare(strict_types=1);

use App\Models\Zone;

test('to array', function (): void {
    $zone = Zone::factory()->create()->refresh();

    expect(array_keys($zone->toArray()))
        ->toBe([
            'id',
            'code',
            'code_odf',
            'olt_latitude',
            'olt_longitude',
            'created_at',
            'updated_at',
        ]);
});
