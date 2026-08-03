<?php

declare(strict_types=1);

use App\Actions\UpdateContract;
use App\Models\Contract;

it('may update a contract', function (): void {
    $contract = Contract::factory()->create([
        'intitule' => 'OLD INTITULE',
    ]);

    $action = resolve(UpdateContract::class);

    $action->handle($contract, [
        'intitule' => 'NEW INTITULE',
    ]);

    expect($contract->refresh()->intitule)->toBe('NEW INTITULE');
});
