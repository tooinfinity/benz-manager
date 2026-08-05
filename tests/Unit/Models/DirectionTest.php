<?php

declare(strict_types=1);

use App\Models\Cmp;
use App\Models\Direction;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

test('relations', function (): void {
    $direction = Direction::factory()->create();

    expect($direction->cmps())->toBeInstanceOf(HasMany::class);

    Cmp::factory()->create(['direction_id' => $direction->id]);

    expect($direction->cmps)->toHaveCount(1)
        ->and($direction->cmps->first())->toBeInstanceOf(Cmp::class);
});
