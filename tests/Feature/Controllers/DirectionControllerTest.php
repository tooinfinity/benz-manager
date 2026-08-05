<?php

declare(strict_types=1);

use App\Models\Direction;
use App\Models\User;

it('renders directions index', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('directions.index'));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('directions/index'));
});

it('renders directions create form', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('directions.create'));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('directions/create'));
});

it('creates a direction', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('directions.create')
        ->post(route('directions.store'), [
            'name' => 'CONSTANTINE',
        ]);

    $response->assertRedirect();

    expect(Direction::query()->where('name', 'CONSTANTINE')->exists())->toBeTrue();
});

it('rejects duplicate direction name', function (): void {
    $user = User::factory()->create();
    Direction::factory()->create(['name' => 'CONSTANTINE']);

    $response = $this->actingAs($user)
        ->fromRoute('directions.create')
        ->post(route('directions.store'), [
            'name' => 'CONSTANTINE',
        ]);

    $response->assertRedirectToRoute('directions.create')
        ->assertSessionHasErrors('name');
});

it('requires name', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('directions.create')
        ->post(route('directions.store'), []);

    $response->assertRedirectToRoute('directions.create')
        ->assertSessionHasErrors('name');
});

it('renders directions show', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();

    $response = $this->actingAs($user)->get(route('directions.show', $direction));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('directions/show'));
});

it('renders directions edit', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();

    $response = $this->actingAs($user)->get(route('directions.edit', $direction));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('directions/edit'));
});

it('updates a direction', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create(['name' => 'CONSTANTINE']);

    $response = $this->actingAs($user)
        ->fromRoute('directions.edit', $direction)
        ->patch(route('directions.update', $direction), [
            'name' => 'ORAN',
        ]);

    $response->assertRedirectToRoute('directions.show', $direction);

    expect($direction->fresh()->name)->toBe('ORAN');
});

it('deletes a direction', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('directions.show', $direction)
        ->delete(route('directions.destroy', $direction));

    $response->assertRedirectToRoute('directions.index');

    expect($direction->fresh())->toBeNull();
});
