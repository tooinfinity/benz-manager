<?php

declare(strict_types=1);

use App\Models\Cmp;

test('to array', function (): void {
    $cmp = Cmp::factory()->create()->refresh();

    expect(array_keys($cmp->toArray()))
        ->toBe([
            'id',
            'direction_id',
            'name',
            'created_at',
            'updated_at',
        ]);
});
