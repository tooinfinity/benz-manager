<?php

declare(strict_types=1);

use App\Actions\CreateCite;
use App\Models\Cite;
use App\Models\Zone;

it('may create a cite', function (): void {
    $zone = Zone::factory()->create();

    $action = resolve(CreateCite::class);

    $cite = $action->handle([
        'zone_id' => $zone->id,
        'code' => 'C250-063-02',
        'name' => 'DAKSI DK B',
    ]);

    expect($cite)->toBeInstanceOf(Cite::class)
        ->and($cite->code)->toBe('C250-063-02')
        ->and($cite->name)->toBe('DAKSI DK B')
        ->and($cite->zone_id)->toBe($zone->id);
});
