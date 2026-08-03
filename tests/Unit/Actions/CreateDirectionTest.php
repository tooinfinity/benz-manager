<?php

declare(strict_types=1);

use App\Actions\CreateDirection;
use App\Models\Direction;

it('may create a direction', function (): void {
    $action = resolve(CreateDirection::class);

    $direction = $action->handle([
        'name' => 'CONSTANTINE',
    ]);

    expect($direction)->toBeInstanceOf(Direction::class)
        ->and($direction->name)->toBe('CONSTANTINE');
});
