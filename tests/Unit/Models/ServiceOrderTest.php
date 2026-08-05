<?php

declare(strict_types=1);

use App\Models\Contract;
use App\Models\ServiceOrder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function (): void {
    $serviceOrder = ServiceOrder::factory()->create()->refresh();

    expect(array_keys($serviceOrder->toArray()))
        ->toBe([
            'id',
            'contract_id',
            'zone_id',
            'numero',
            'nombre_logements',
            'date_ouverture',
            'date_reception',
            'date_reversement',
            'created_at',
            'updated_at',
        ]);
});

test('relations', function (): void {
    $serviceOrder = ServiceOrder::factory()->create();

    expect($serviceOrder->contract())->toBeInstanceOf(BelongsTo::class)
        ->and($serviceOrder->zone())->toBeInstanceOf(BelongsTo::class)
        ->and($serviceOrder->sros())->toBeInstanceOf(HasMany::class)
        ->and($serviceOrder->signatories())->toBeInstanceOf(HasMany::class);

    expect($serviceOrder->contract)->toBeInstanceOf(Contract::class);
});
