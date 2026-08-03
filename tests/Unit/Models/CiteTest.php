<?php

declare(strict_types=1);

use App\Models\Cite;

test('to array', function (): void {
    $cite = Cite::factory()->create()->refresh();

    expect(array_keys($cite->toArray()))
        ->toBe([
            'id',
            'zone_id',
            'sro_id',
            'code',
            'name',
            'latitude',
            'longitude',
            'created_at',
            'updated_at',
        ]);
});
