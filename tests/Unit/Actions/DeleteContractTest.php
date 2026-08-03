<?php

declare(strict_types=1);

use App\Actions\DeleteContract;
use App\Models\Contract;

it('may delete a contract', function (): void {
    $contract = Contract::factory()->create();

    $action = resolve(DeleteContract::class);

    $action->handle($contract);

    expect($contract->exists)->toBeFalse();
});
