<?php

declare(strict_types=1);

use App\Actions\CreateServiceOrderSignatory;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderSignatory;

it('may create a service order signatory', function (): void {
    $serviceOrder = ServiceOrder::factory()->create();

    $action = resolve(CreateServiceOrderSignatory::class);

    $signatory = $action->handle([
        'service_order_id' => $serviceOrder->id,
        'role' => 'DO',
        'name' => 'John Doe',
    ]);

    expect($signatory)->toBeInstanceOf(ServiceOrderSignatory::class)
        ->and($signatory->role->value)->toBe('DO')
        ->and($signatory->name)->toBe('John Doe')
        ->and($signatory->service_order_id)->toBe($serviceOrder->id);
});
