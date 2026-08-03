<?php

declare(strict_types=1);

use App\Actions\CreateZone;
use App\Models\Zone;

it('may create a zone', function (): void {
    $action = resolve(CreateZone::class);

    $zone = $action->handle([
        'code' => 'Z250-063',
    ]);

    expect($zone)->toBeInstanceOf(Zone::class)
        ->and($zone->code)->toBe('Z250-063');
});
