<?php

declare(strict_types=1);

use App\Actions\CreateCmp;
use App\Models\Cmp;
use App\Models\Direction;

it('may create a cmp', function (): void {
    $direction = Direction::factory()->create();

    $action = resolve(CreateCmp::class);

    $cmp = $action->handle([
        'direction_id' => $direction->id,
        'name' => 'SIDI MABROUK',
    ]);

    expect($cmp)->toBeInstanceOf(Cmp::class)
        ->and($cmp->name)->toBe('SIDI MABROUK')
        ->and($cmp->direction_id)->toBe($direction->id);
});
