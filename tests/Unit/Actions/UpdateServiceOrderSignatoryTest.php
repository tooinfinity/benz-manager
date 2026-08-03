<?php

declare(strict_types=1);

use App\Actions\UpdateServiceOrderSignatory;
use App\Models\ServiceOrderSignatory;

it('may update a service order signatory', function (): void {
    $signatory = ServiceOrderSignatory::factory()->create([
        'name' => 'OLD NAME',
    ]);

    $action = resolve(UpdateServiceOrderSignatory::class);

    $action->handle($signatory, [
        'name' => 'NEW NAME',
    ]);

    expect($signatory->refresh()->name)->toBe('NEW NAME');
});
