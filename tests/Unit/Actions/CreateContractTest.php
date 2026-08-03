<?php

declare(strict_types=1);

use App\Actions\CreateContract;
use App\Models\Cmp;
use App\Models\Contract;

it('may create a contract', function (): void {
    $cmp = Cmp::factory()->create();

    $action = resolve(CreateContract::class);

    $contract = $action->handle([
        'cmp_id' => $cmp->id,
        'numero' => '138/SDFS/DAL/SA/2023',
        'intitule' => 'FTTH Constantine Phase 1',
        'nature_travaux' => 'Developpement',
        'technologie' => 'FTTH',
    ]);

    expect($contract)->toBeInstanceOf(Contract::class)
        ->and($contract->numero)->toBe('138/SDFS/DAL/SA/2023')
        ->and($contract->cmp_id)->toBe($cmp->id);
});
