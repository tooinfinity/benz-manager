<?php

declare(strict_types=1);

use App\Actions\DeleteServiceOrderSignatory;
use App\Models\ServiceOrderSignatory;

it('may delete a service order signatory', function (): void {
    $signatory = ServiceOrderSignatory::factory()->create();

    $action = resolve(DeleteServiceOrderSignatory::class);

    $action->handle($signatory);

    expect($signatory->exists)->toBeFalse();
});
