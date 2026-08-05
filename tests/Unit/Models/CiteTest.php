<?php

declare(strict_types=1);

use App\Models\Cite;
use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('to array', function (): void {
    $cite = Cite::factory()->create()->refresh();

    expect(array_keys($cite->toArray()))
        ->toBe([
            'id',
            'zone_id',
            'sro_id',
            'code',
            'name',
            'latitude',
            'longitude',
            'created_at',
            'updated_at',
        ]);
});

test('relations', function (): void {
    $cite = Cite::factory()->create();

    expect($cite->zone())->toBeInstanceOf(BelongsTo::class)
        ->and($cite->sro())->toBeInstanceOf(BelongsTo::class);

    expect($cite->zone)->toBeInstanceOf(Zone::class)
        ->and($cite->sro)->toBeInstanceOf(Sro::class);
});
