<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Zone;

it('renders zones index', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('zones.index'));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('zones/index'));
});

it('renders zones create form', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('zones.create'));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('zones/create'));
});

it('creates a zone', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('zones.create')
        ->post(route('zones.store'), [
            'code' => 'Z250-063',
            'code_odf' => 'ODF-001',
            'olt_latitude' => 36.365,
            'olt_longitude' => 6.6147,
        ]);

    $response->assertRedirect();

    expect(Zone::query()->where('code', 'Z250-063')->exists())->toBeTrue();
});

it('rejects duplicate zone code', function (): void {
    $user = User::factory()->create();
    Zone::factory()->create(['code' => 'Z250-063']);

    $response = $this->actingAs($user)
        ->fromRoute('zones.create')
        ->post(route('zones.store'), [
            'code' => 'Z250-063',
        ]);

    $response->assertRedirectToRoute('zones.create')
        ->assertSessionHasErrors('code');
});

it('requires code', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('zones.create')
        ->post(route('zones.store'), []);

    $response->assertRedirectToRoute('zones.create')
        ->assertSessionHasErrors('code');
});

it('rejects out-of-range latitude', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('zones.create')
        ->post(route('zones.store'), [
            'code' => 'Z250-099',
            'olt_latitude' => 200,
        ]);

    $response->assertRedirectToRoute('zones.create')
        ->assertSessionHasErrors('olt_latitude');
});

it('renders zones show', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)->get(route('zones.show', $zone));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('zones/show'));
});

it('renders zones edit', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)->get(route('zones.edit', $zone));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('zones/edit'));
});

it('updates a zone', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create(['code' => 'Z250-063']);

    $response = $this->actingAs($user)
        ->fromRoute('zones.edit', $zone)
        ->patch(route('zones.update', $zone), [
            'code' => 'Z250-099',
            'code_odf' => 'ODF-002',
        ]);

    $response->assertRedirectToRoute('zones.show', $zone);

    expect($zone->fresh()->code)->toBe('Z250-099');
});

it('deletes a zone', function (): void {
    $user = User::factory()->create();
    $zone = Zone::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('zones.show', $zone)
        ->delete(route('zones.destroy', $zone));

    $response->assertRedirectToRoute('zones.index');

    expect($zone->fresh())->toBeNull();
});
