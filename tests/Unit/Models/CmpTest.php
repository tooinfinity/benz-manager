<?php

declare(strict_types=1);

use App\Models\Cmp;
use App\Models\Direction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

test('relations', function (): void {
    $cmp = Cmp::factory()->create();

    expect($cmp->direction())->toBeInstanceOf(BelongsTo::class)
        ->and($cmp->contracts())->toBeInstanceOf(HasMany::class);

    expect($cmp->direction)->toBeInstanceOf(Direction::class);
});
