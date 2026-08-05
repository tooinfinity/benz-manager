<?php

declare(strict_types=1);

use App\Models\Cite;
use App\Models\ServiceOrder;
use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function (): void {
    $zone = Zone::factory()->create()->refresh();

    expect(array_keys($zone->toArray()))
        ->toBe([
            'id',
            'code',
            'code_odf',
            'olt_latitude',
            'olt_longitude',
            'created_at',
            'updated_at',
        ]);
});

test('relations', function (): void {
    $zone = Zone::factory()->create();

    expect($zone->sros())->toBeInstanceOf(HasMany::class)
        ->and($zone->cites())->toBeInstanceOf(HasMany::class)
        ->and($zone->serviceOrders())->toBeInstanceOf(HasMany::class);

    Sro::factory()->create(['zone_id' => $zone->id]);
    Cite::factory()->create(['zone_id' => $zone->id]);
    ServiceOrder::factory()->create(['zone_id' => $zone->id]);

    expect($zone->sros)->toHaveCount(1)
        ->and($zone->cites)->toHaveCount(1)
        ->and($zone->serviceOrders)->toHaveCount(1);
});
