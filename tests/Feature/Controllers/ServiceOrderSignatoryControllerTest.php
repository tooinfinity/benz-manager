<?php

declare(strict_types=1);

use App\Enums\SignatoryRole;
use App\Models\Cmp;
use App\Models\Contract;
use App\Models\Direction;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderSignatory;
use App\Models\User;
use App\Models\Zone;

it('renders signatories index', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();

    $response = $this->actingAs($user)
        ->get(route('service-orders.signatories.index', [$direction, $cmp, $contract, $serviceOrder]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-order-signatories/index'));
});

it('renders signatories create form', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();

    $response = $this->actingAs($user)
        ->get(route('service-orders.signatories.create', [$direction, $cmp, $contract, $serviceOrder]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-order-signatories/create'));
});

it('creates a signatory', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();

    $response = $this->actingAs($user)
        ->fromRoute('service-orders.signatories.create', [$direction, $cmp, $contract, $serviceOrder])
        ->post(route('service-orders.signatories.store', [$direction, $cmp, $contract, $serviceOrder]), [
            'role' => SignatoryRole::Cil->value,
            'name' => 'John Doe',
        ]);

    $response->assertRedirect();

    expect(ServiceOrderSignatory::query()->where('role', SignatoryRole::Cil->value)->where('service_order_id', $serviceOrder->id)->exists())->toBeTrue();
});

it('rejects duplicate role for same service order', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();
    ServiceOrderSignatory::factory()->create([
        'service_order_id' => $serviceOrder->id,
        'role' => SignatoryRole::Cil,
    ]);

    $response = $this->actingAs($user)
        ->fromRoute('service-orders.signatories.create', [$direction, $cmp, $contract, $serviceOrder])
        ->post(route('service-orders.signatories.store', [$direction, $cmp, $contract, $serviceOrder]), [
            'role' => SignatoryRole::Cil->value,
            'name' => 'Jane',
        ]);

    $response->assertRedirectToRoute('service-orders.signatories.create', [$direction, $cmp, $contract, $serviceOrder])
        ->assertSessionHasErrors('role');
});

it('rejects invalid role enum value', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();

    $response = $this->actingAs($user)
        ->fromRoute('service-orders.signatories.create', [$direction, $cmp, $contract, $serviceOrder])
        ->post(route('service-orders.signatories.store', [$direction, $cmp, $contract, $serviceOrder]), [
            'role' => 'NotAValidRole',
        ]);

    $response->assertRedirectToRoute('service-orders.signatories.create', [$direction, $cmp, $contract, $serviceOrder])
        ->assertSessionHasErrors('role');
});

it('renders signatories show', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();
    $signatory = ServiceOrderSignatory::factory()->create(['service_order_id' => $serviceOrder->id]);

    $response = $this->actingAs($user)
        ->get(route('service-orders.signatories.show', [$direction, $cmp, $contract, $serviceOrder, $signatory]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-order-signatories/show'));
});

it('renders signatories edit', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();
    $signatory = ServiceOrderSignatory::factory()->create(['service_order_id' => $serviceOrder->id]);

    $response = $this->actingAs($user)
        ->get(route('service-orders.signatories.edit', [$direction, $cmp, $contract, $serviceOrder, $signatory]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-order-signatories/edit'));
});

it('updates a signatory', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();
    $signatory = ServiceOrderSignatory::factory()->create([
        'service_order_id' => $serviceOrder->id,
        'name' => 'OLD',
    ]);

    $response = $this->actingAs($user)
        ->fromRoute('service-orders.signatories.edit', [$direction, $cmp, $contract, $serviceOrder, $signatory])
        ->patch(route('service-orders.signatories.update', [$direction, $cmp, $contract, $serviceOrder, $signatory]), [
            'role' => $signatory->role->value,
            'name' => 'NEW',
        ]);

    $response->assertRedirectToRoute('service-orders.signatories.show', [$direction, $cmp, $contract, $serviceOrder, $signatory]);

    expect($signatory->fresh()->name)->toBe('NEW');
});

it('deletes a signatory', function (): void {
    $user = User::factory()->create();
    [$direction, $cmp, $contract, $serviceOrder] = makeServiceOrderChain();
    $signatory = ServiceOrderSignatory::factory()->create(['service_order_id' => $serviceOrder->id]);

    $response = $this->actingAs($user)
        ->fromRoute('service-orders.signatories.show', [$direction, $cmp, $contract, $serviceOrder, $signatory])
        ->delete(route('service-orders.signatories.destroy', [$direction, $cmp, $contract, $serviceOrder, $signatory]));

    $response->assertRedirectToRoute('service-orders.signatories.index', [$direction, $cmp, $contract, $serviceOrder]);

    expect($signatory->fresh())->toBeNull();
});

/**
 * @return array{0: Direction, 1: Cmp, 2: Contract, 3: ServiceOrder}
 */
function makeServiceOrderChain(): array
{
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();
    $serviceOrder = ServiceOrder::factory()->create([
        'contract_id' => $contract->id,
        'zone_id' => $zone->id,
    ]);

    return [$direction, $cmp, $contract, $serviceOrder];
}
