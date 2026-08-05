<?php

declare(strict_types=1);

use App\Models\ServiceOrder;
use App\Models\ServiceOrderSignatory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('to array', function (): void {
    $signatory = ServiceOrderSignatory::factory()->create()->refresh();

    expect(array_keys($signatory->toArray()))
        ->toBe([
            'id',
            'service_order_id',
            'role',
            'name',
            'created_at',
            'updated_at',
        ]);
});

test('relations', function (): void {
    $serviceOrder = ServiceOrder::factory()->create();
    $signatory = ServiceOrderSignatory::factory()->create(['service_order_id' => $serviceOrder->id]);

    expect($signatory->serviceOrder())->toBeInstanceOf(BelongsTo::class);

    expect($signatory->serviceOrder)->toBeInstanceOf(ServiceOrder::class);
});
