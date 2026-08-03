<?php

declare(strict_types=1);

use App\Actions\DeleteServiceOrder;
use App\Models\ServiceOrder;

it('may delete a service order', function (): void {
    $serviceOrder = ServiceOrder::factory()->create();

    $action = resolve(DeleteServiceOrder::class);

    $action->handle($serviceOrder);

    expect($serviceOrder->exists)->toBeFalse();
});
