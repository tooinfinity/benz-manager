<?php

declare(strict_types=1);

use App\Models\Cite;
use App\Models\ServiceOrder;
use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function (): void {
    $sro = Sro::factory()->create()->refresh();

    expect(array_keys($sro->toArray()))
        ->toBe([
            'id',
            'zone_id',
            'service_order_id',
            'code',
            'created_at',
            'updated_at',
        ]);
});

test('relations', function (): void {
    $zone = Zone::factory()->create();
    $serviceOrder = ServiceOrder::factory()->create(['zone_id' => $zone->id]);
    $sro = Sro::factory()->create([
        'zone_id' => $zone->id,
        'service_order_id' => $serviceOrder->id,
    ]);

    expect($sro->zone())->toBeInstanceOf(BelongsTo::class)
        ->and($sro->serviceOrder())->toBeInstanceOf(BelongsTo::class)
        ->and($sro->cites())->toBeInstanceOf(HasMany::class);

    expect($sro->zone)->toBeInstanceOf(Zone::class)
        ->and($sro->serviceOrder)->toBeInstanceOf(ServiceOrder::class);

    Cite::factory()->create(['sro_id' => $sro->id]);

    expect($sro->cites)->toHaveCount(1)
        ->and($sro->cites->first())->toBeInstanceOf(Cite::class);
});
