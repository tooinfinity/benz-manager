<?php

declare(strict_types=1);

use App\Actions\DeleteZone;
use App\Models\Zone;

it('may delete a zone', function (): void {
    $zone = Zone::factory()->create();

    $action = resolve(DeleteZone::class);

    $action->handle($zone);

    expect($zone->exists)->toBeFalse();
});
