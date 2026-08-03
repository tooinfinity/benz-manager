<?php

declare(strict_types=1);

use App\Models\Direction;

test('to array', function (): void {
    $direction = Direction::factory()->create()->refresh();

    expect(array_keys($direction->toArray()))
        ->toBe([
            'id',
            'name',
            'created_at',
            'updated_at',
        ]);
});
