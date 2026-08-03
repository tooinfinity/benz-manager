<?php

declare(strict_types=1);

use App\Models\Contract;

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
