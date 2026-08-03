<?php

declare(strict_types=1);

use App\Actions\CreateSro;
use App\Models\Sro;
use App\Models\Zone;

it('may create an sro', function (): void {
    $zone = Zone::factory()->create();

    $action = resolve(CreateSro::class);

    $sro = $action->handle([
        'zone_id' => $zone->id,
        'code' => 'C250-063-02-02',
    ]);

    expect($sro)->toBeInstanceOf(Sro::class)
        ->and($sro->code)->toBe('C250-063-02-02')
        ->and($sro->zone_id)->toBe($zone->id);
});
