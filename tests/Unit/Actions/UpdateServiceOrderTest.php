<?php

declare(strict_types=1);

use App\Actions\UpdateServiceOrder;
use App\Models\ServiceOrder;

it('may update a service order', function (): void {
    $serviceOrder = ServiceOrder::factory()->create([
        'nombre_logements' => 10,
    ]);

    $action = resolve(UpdateServiceOrder::class);

    $action->handle($serviceOrder, [
        'nombre_logements' => 250,
    ]);

    expect($serviceOrder->refresh()->nombre_logements)->toBe('250');
});
