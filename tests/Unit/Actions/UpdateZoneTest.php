<?php

declare(strict_types=1);

use App\Actions\UpdateZone;
use App\Models\Zone;

it('may update a zone', function (): void {
    $zone = Zone::factory()->create([
        'code' => 'Z100-001',
    ]);

    $action = resolve(UpdateZone::class);

    $action->handle($zone, [
        'code' => 'Z200-002',
    ]);

    expect($zone->refresh()->code)->toBe('Z200-002');
});
