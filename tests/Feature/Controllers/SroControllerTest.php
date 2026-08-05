<?php

declare(strict_types=1);

use App\Models\Sro;
use App\Models\User;
use App\Models\Zone;

it('renders sros index', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)->get(route('zones.sros.index', $zone));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('sros/index'));
});

it('renders sros create form', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)->get(route('zones.sros.create', $zone));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('sros/create'));
});

it('creates an sro', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('zones.sros.create', $zone)
        ->post(route('zones.sros.store', $zone), [
            'code' => 'C250-063-02-02',
        ]);

    $response->assertRedirect();

    expect(Sro::query()->where('code', 'C250-063-02-02')->where('zone_id', $zone->id)->exists())->toBeTrue();
});

it('rejects duplicate sro code', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    Sro::factory()->create(['code' => 'C250-063-02-02']);

    $response = $this->actingAs($user)
        ->fromRoute('zones.sros.create', $zone)
        ->post(route('zones.sros.store', $zone), [
            'code' => 'C250-063-02-02',
        ]);

    $response->assertRedirectToRoute('zones.sros.create', $zone)
        ->assertSessionHasErrors('code');
});

it('renders sros show', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);

    $response = $this->actingAs($user)->get(route('zones.sros.show', [$zone, $sro]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('sros/show'));
});

it('renders sros edit', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);

    $response = $this->actingAs($user)->get(route('zones.sros.edit', [$zone, $sro]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('sros/edit'));
});

it('updates an sro', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id, 'code' => 'C250-063-02-02']);

    $response = $this->actingAs($user)
        ->fromRoute('zones.sros.edit', [$zone, $sro])
        ->patch(route('zones.sros.update', [$zone, $sro]), [
            'code' => 'C250-099-99-99',
        ]);

    $response->assertRedirectToRoute('zones.sros.show', [$zone, $sro]);

    expect($sro->fresh()->code)->toBe('C250-099-99-99');
});

it('deletes an sro', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);

    $response = $this->actingAs($user)
        ->fromRoute('zones.sros.show', [$zone, $sro])
        ->delete(route('zones.sros.destroy', [$zone, $sro]));

    $response->assertRedirectToRoute('zones.sros.index', [$zone]);

    expect($sro->fresh())->toBeNull();
});
