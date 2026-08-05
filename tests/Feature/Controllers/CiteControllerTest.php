<?php

declare(strict_types=1);

use App\Models\Cite;
use App\Models\Sro;
use App\Models\User;
use App\Models\Zone;

it('renders cites index', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);

    $response = $this->actingAs($user)->get(route('sros.cites.index', [$zone, $sro]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cites/index'));
});

it('renders cites create form', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);

    $response = $this->actingAs($user)->get(route('sros.cites.create', [$zone, $sro]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cites/create'));
});

it('creates a cite', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);

    $response = $this->actingAs($user)
        ->fromRoute('sros.cites.create', [$zone, $sro])
        ->post(route('sros.cites.store', [$zone, $sro]), [
            'code' => 'C250-063-02',
            'name' => 'DAKSI DK B',
            'latitude' => 36.5,
            'longitude' => 6.7,
        ]);

    $response->assertRedirect();

    expect(Cite::query()->where('code', 'C250-063-02')->where('sro_id', $sro->id)->exists())->toBeTrue();
});

it('rejects duplicate cite code', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);
    Cite::factory()->create(['code' => 'C250-063-02']);

    $response = $this->actingAs($user)
        ->fromRoute('sros.cites.create', [$zone, $sro])
        ->post(route('sros.cites.store', [$zone, $sro]), [
            'code' => 'C250-063-02',
            'name' => 'DAKSI DK B',
        ]);

    $response->assertRedirectToRoute('sros.cites.create', [$zone, $sro])
        ->assertSessionHasErrors('code');
});

it('requires code and name', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);

    $response = $this->actingAs($user)
        ->fromRoute('sros.cites.create', [$zone, $sro])
        ->post(route('sros.cites.store', [$zone, $sro]), []);

    $response->assertRedirectToRoute('sros.cites.create', [$zone, $sro])
        ->assertSessionHasErrors(['code', 'name']);
});

it('renders cites show', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);
    $cite = Cite::factory()->create(['zone_id' => $zone->id, 'sro_id' => $sro->id]);

    $response = $this->actingAs($user)->get(route('sros.cites.show', [$zone, $sro, $cite]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cites/show'));
});

it('renders cites edit', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);
    $cite = Cite::factory()->create(['zone_id' => $zone->id, 'sro_id' => $sro->id]);

    $response = $this->actingAs($user)->get(route('sros.cites.edit', [$zone, $sro, $cite]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cites/edit'));
});

it('updates a cite', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);
    $cite = Cite::factory()->create([
        'zone_id' => $zone->id,
        'sro_id' => $sro->id,
        'name' => 'OLD',
    ]);

    $response = $this->actingAs($user)
        ->fromRoute('sros.cites.edit', [$zone, $sro, $cite])
        ->patch(route('sros.cites.update', [$zone, $sro, $cite]), [
            'code' => $cite->code,
            'name' => 'NEW',
        ]);

    $response->assertRedirectToRoute('sros.cites.show', [$zone, $sro, $cite]);

    expect($cite->fresh()->name)->toBe('NEW');
});

it('deletes a cite', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    $sro = Sro::factory()->create(['zone_id' => $zone->id]);
    $cite = Cite::factory()->create(['zone_id' => $zone->id, 'sro_id' => $sro->id]);

    $response = $this->actingAs($user)
        ->fromRoute('sros.cites.show', [$zone, $sro, $cite])
        ->delete(route('sros.cites.destroy', [$zone, $sro, $cite]));

    $response->assertRedirectToRoute('sros.cites.index', [$zone, $sro]);

    expect($cite->fresh())->toBeNull();
});
