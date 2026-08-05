<?php

declare(strict_types=1);

use App\Models\Cmp;
use App\Models\Contract;
use App\Models\Direction;
use App\Models\ServiceOrder;
use App\Models\User;
use App\Models\Zone;

it('renders service orders index', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);

    $response = $this->actingAs($user)
        ->get(route('contracts.service-orders.index', [$direction, $cmp, $contract]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-orders/index'));
});

it('renders service orders create form', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    Zone::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('contracts.service-orders.create', [$direction, $cmp, $contract]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-orders/create'));
});

it('creates a service order', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('contracts.service-orders.create', [$direction, $cmp, $contract])
        ->post(route('contracts.service-orders.store', [$direction, $cmp, $contract]), [
            'contract_id' => $contract->id,
            'numero' => 'AT/DOT/N°143/SDTO/DRA/RU-ODN/2025',
            'zone_id' => $zone->id,
            'nombre_logements' => 100,
            'date_ouverture' => '2025-01-15',
        ]);

    $response->assertRedirect();

    expect(ServiceOrder::query()->where('numero', 'AT/DOT/N°143/SDTO/DRA/RU-ODN/2025')->exists())->toBeTrue();
});

it('rejects duplicate service order numero', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();
    ServiceOrder::factory()->create(['numero' => 'AT/DOT/N°143/SDTO/DRA/RU-ODN/2025']);

    $response = $this->actingAs($user)
        ->fromRoute('contracts.service-orders.create', [$direction, $cmp, $contract])
        ->post(route('contracts.service-orders.store', [$direction, $cmp, $contract]), [
            'contract_id' => $contract->id,
            'numero' => 'AT/DOT/N°143/SDTO/DRA/RU-ODN/2025',
            'zone_id' => $zone->id,
        ]);

    $response->assertRedirectToRoute('contracts.service-orders.create', [$direction, $cmp, $contract])
        ->assertSessionHasErrors('numero');
});

it('requires numero', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('contracts.service-orders.create', [$direction, $cmp, $contract])
        ->post(route('contracts.service-orders.store', [$direction, $cmp, $contract]), [
            'contract_id' => $contract->id,
            'zone_id' => $zone->id,
        ]);

    $response->assertRedirectToRoute('contracts.service-orders.create', [$direction, $cmp, $contract])
        ->assertSessionHasErrors('numero');
});

it('renders service orders show', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();
    $serviceOrder = ServiceOrder::factory()->create([
        'contract_id' => $contract->id,
        'zone_id' => $zone->id,
    ]);

    $response = $this->actingAs($user)
        ->get(route('contracts.service-orders.show', [$direction, $cmp, $contract, $serviceOrder]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-orders/show'));
});

it('renders service orders edit', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();
    $serviceOrder = ServiceOrder::factory()->create([
        'contract_id' => $contract->id,
        'zone_id' => $zone->id,
    ]);

    $response = $this->actingAs($user)
        ->get(route('contracts.service-orders.edit', [$direction, $cmp, $contract, $serviceOrder]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('service-orders/edit'));
});

it('updates a service order', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();
    $serviceOrder = ServiceOrder::factory()->create([
        'contract_id' => $contract->id,
        'zone_id' => $zone->id,
        'nombre_logements' => 50,
    ]);

    $response = $this->actingAs($user)
        ->fromRoute('contracts.service-orders.edit', [$direction, $cmp, $contract, $serviceOrder])
        ->patch(route('contracts.service-orders.update', [$direction, $cmp, $contract, $serviceOrder]), [
            'contract_id' => $contract->id,
            'numero' => $serviceOrder->numero,
            'zone_id' => $zone->id,
            'nombre_logements' => 200,
        ]);

    $response->assertRedirectToRoute('contracts.service-orders.show', [$direction, $cmp, $contract, $serviceOrder]);

    expect((int) $serviceOrder->fresh()->nombre_logements)->toBe(200);
});

it('deletes a service order', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);
    $zone = Zone::factory()->create();
    $serviceOrder = ServiceOrder::factory()->create([
        'contract_id' => $contract->id,
        'zone_id' => $zone->id,
    ]);

    $response = $this->actingAs($user)
        ->fromRoute('contracts.service-orders.show', [$direction, $cmp, $contract, $serviceOrder])
        ->delete(route('contracts.service-orders.destroy', [$direction, $cmp, $contract, $serviceOrder]));

    $response->assertRedirectToRoute('contracts.service-orders.index', [$direction, $cmp, $contract]);

    expect($serviceOrder->fresh())->toBeNull();
});
