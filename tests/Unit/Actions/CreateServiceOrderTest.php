<?php

declare(strict_types=1);

use App\Actions\CreateServiceOrder;
use App\Models\Contract;
use App\Models\ServiceOrder;
use App\Models\Zone;

it('may create a service order', function (): void {
    $contract = Contract::factory()->create();
    $zone = Zone::factory()->create();

    $action = resolve(CreateServiceOrder::class);

    $serviceOrder = $action->handle([
        'contract_id' => $contract->id,
        'zone_id' => $zone->id,
        'numero' => 'AT/DOT/N°143/SDTO/DRA/RU-ODN/2024',
    ]);

    expect($serviceOrder)->toBeInstanceOf(ServiceOrder::class)
        ->and($serviceOrder->numero)->toBe('AT/DOT/N°143/SDTO/DRA/RU-ODN/2024')
        ->and($serviceOrder->contract_id)->toBe($contract->id)
        ->and($serviceOrder->zone_id)->toBe($zone->id);
});
