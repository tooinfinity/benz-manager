<?php

declare(strict_types=1);

use App\Actions\DeleteDirection;
use App\Models\Direction;

it('may delete a direction', function (): void {
    $direction = Direction::factory()->create();

    $action = resolve(DeleteDirection::class);

    $action->handle($direction);

    expect($direction->exists)->toBeFalse();
});
