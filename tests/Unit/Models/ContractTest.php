<?php

declare(strict_types=1);

use App\Models\Cmp;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function (): void {
    $contract = Contract::factory()->create()->refresh();

    expect(array_keys($contract->toArray()))
        ->toBe([
            'id',
            'cmp_id',
            'numero',
            'intitule',
            'nature_travaux',
            'technologie',
            'created_at',
            'updated_at',
        ]);
});

test('relations', function (): void {
    $contract = Contract::factory()->create();

    expect($contract->cmp())->toBeInstanceOf(BelongsTo::class)
        ->and($contract->serviceOrders())->toBeInstanceOf(HasMany::class);

    expect($contract->cmp)->toBeInstanceOf(Cmp::class);
});
