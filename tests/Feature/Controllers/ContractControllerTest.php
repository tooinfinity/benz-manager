<?php

declare(strict_types=1);

use App\Enums\NatureTravaux;
use App\Enums\Technologie;
use App\Models\Cmp;
use App\Models\Contract;
use App\Models\Direction;
use App\Models\User;

it('renders contracts index', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);

    $response = $this->actingAs($user)->get(route('cmps.contracts.index', [$direction, $cmp]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('contracts/index'));
});

it('renders contracts create form', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);

    $response = $this->actingAs($user)->get(route('cmps.contracts.create', [$direction, $cmp]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('contracts/create'));
});

it('creates a contract', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);

    $response = $this->actingAs($user)
        ->fromRoute('cmps.contracts.create', [$direction, $cmp])
        ->post(route('cmps.contracts.store', [$direction, $cmp]), [
            'cmp_id' => $cmp->id,
            'numero' => '138/SDFS/DAL/SA/2025',
            'intitule' => 'Test contract',
            'nature_travaux' => NatureTravaux::Developpement->value,
            'technologie' => Technologie::Ftth->value,
        ]);

    $response->assertRedirect();

    expect(Contract::query()->where('numero', '138/SDFS/DAL/SA/2025')->exists())->toBeTrue();
});

it('rejects duplicate contract numero', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    Contract::factory()->create(['numero' => '138/SDFS/DAL/SA/2025']);

    $response = $this->actingAs($user)
        ->fromRoute('cmps.contracts.create', [$direction, $cmp])
        ->post(route('cmps.contracts.store', [$direction, $cmp]), [
            'cmp_id' => $cmp->id,
            'numero' => '138/SDFS/DAL/SA/2025',
            'intitule' => 'Dup',
            'nature_travaux' => NatureTravaux::Developpement->value,
            'technologie' => Technologie::Ftth->value,
        ]);

    $response->assertRedirectToRoute('cmps.contracts.create', [$direction, $cmp])
        ->assertSessionHasErrors('numero');
});

it('requires numero', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);

    $response = $this->actingAs($user)
        ->fromRoute('cmps.contracts.create', [$direction, $cmp])
        ->post(route('cmps.contracts.store', [$direction, $cmp]), [
            'cmp_id' => $cmp->id,
            'intitule' => 'Test',
            'nature_travaux' => NatureTravaux::Developpement->value,
            'technologie' => Technologie::Ftth->value,
        ]);

    $response->assertRedirectToRoute('cmps.contracts.create', [$direction, $cmp])
        ->assertSessionHasErrors('numero');
});

it('renders contracts show', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);

    $response = $this->actingAs($user)->get(route('cmps.contracts.show', [$direction, $cmp, $contract]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('contracts/show'));
});

it('renders contracts edit', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);

    $response = $this->actingAs($user)->get(route('cmps.contracts.edit', [$direction, $cmp, $contract]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('contracts/edit'));
});

it('updates a contract', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id, 'intitule' => 'OLD']);

    $response = $this->actingAs($user)
        ->fromRoute('cmps.contracts.edit', [$direction, $cmp, $contract])
        ->patch(route('cmps.contracts.update', [$direction, $cmp, $contract]), [
            'cmp_id' => $cmp->id,
            'numero' => $contract->numero,
            'intitule' => 'NEW',
            'nature_travaux' => NatureTravaux::Extension->value,
            'technologie' => Technologie::Ftto->value,
        ]);

    $response->assertRedirectToRoute('cmps.contracts.show', [$direction, $cmp, $contract]);

    expect($contract->fresh()->intitule)->toBe('NEW');
});

it('deletes a contract', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);
    $contract = Contract::factory()->create(['cmp_id' => $cmp->id]);

    $response = $this->actingAs($user)
        ->fromRoute('cmps.contracts.show', [$direction, $cmp, $contract])
        ->delete(route('cmps.contracts.destroy', [$direction, $cmp, $contract]));

    $response->assertRedirectToRoute('cmps.contracts.index', [$direction, $cmp]);

    expect($contract->fresh())->toBeNull();
});
