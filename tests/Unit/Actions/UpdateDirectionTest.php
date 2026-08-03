<?php

declare(strict_types=1);

use App\Actions\UpdateDirection;
use App\Models\Direction;

it('may update a direction', function (): void {
    $direction = Direction::factory()->create([
        'name' => 'CONSTANTINE',
    ]);

    $action = resolve(UpdateDirection::class);

    $action->handle($direction, [
        'name' => 'ALGIERS',
    ]);

    expect($direction->refresh()->name)->toBe('ALGIERS');
});
