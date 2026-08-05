<?php

declare(strict_types=1);

use App\Models\Cmp;
use App\Models\Direction;
use App\Models\User;

it('renders cmps index', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();

    $response = $this->actingAs($user)->get(route('directions.cmps.index', $direction));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cmps/index'));
});

it('renders cmps create form', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();

    $response = $this->actingAs($user)->get(route('directions.cmps.create', $direction));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cmps/create'));
});

it('creates a cmp', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();

    $response = $this->actingAs($user)
        ->fromRoute('directions.cmps.create', $direction)
        ->post(route('directions.cmps.store', $direction), [
            'name' => 'SIDI MABROUK',
        ]);

    $response->assertRedirect();

    expect(Cmp::query()->where('name', 'SIDI MABROUK')->where('direction_id', $direction->id)->exists())->toBeTrue();
});

it('rejects duplicate cmp within direction', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    Cmp::factory()->create(['direction_id' => $direction->id, 'name' => 'SIDI MABROUK']);

    $response = $this->actingAs($user)
        ->fromRoute('directions.cmps.create', $direction)
        ->post(route('directions.cmps.store', $direction), [
            'name' => 'SIDI MABROUK',
        ]);

    $response->assertRedirectToRoute('directions.cmps.create', $direction)
        ->assertSessionHasErrors('name');
});

it('allows same cmp name in different directions', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $otherDirection = Direction::factory()->create();
    Cmp::factory()->create(['direction_id' => $otherDirection->id, 'name' => 'SIDI MABROUK']);

    $response = $this->actingAs($user)
        ->fromRoute('directions.cmps.create', $direction)
        ->post(route('directions.cmps.store', $direction), [
            'name' => 'SIDI MABROUK',
        ]);

    $response->assertRedirect();
});

it('renders cmps show', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);

    $response = $this->actingAs($user)->get(route('directions.cmps.show', [$direction, $cmp]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cmps/show'));
});

it('renders cmps edit', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);

    $response = $this->actingAs($user)->get(route('directions.cmps.edit', [$direction, $cmp]));

    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('cmps/edit'));
});

it('updates a cmp', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id, 'name' => 'OLD']);

    $response = $this->actingAs($user)
        ->fromRoute('directions.cmps.edit', [$direction, $cmp])
        ->patch(route('directions.cmps.update', [$direction, $cmp]), [
            'name' => 'NEW',
        ]);

    $response->assertRedirectToRoute('directions.cmps.show', [$direction, $cmp]);

    expect($cmp->fresh()->name)->toBe('NEW');
});

it('deletes a cmp', function (): void {
    $user = User::factory()->create();
    $direction = Direction::factory()->create();
    $cmp = Cmp::factory()->create(['direction_id' => $direction->id]);

    $response = $this->actingAs($user)
        ->fromRoute('directions.cmps.show', [$direction, $cmp])
        ->delete(route('directions.cmps.destroy', [$direction, $cmp]));

    $response->assertRedirectToRoute('directions.cmps.index', [$direction]);

    expect($cmp->fresh())->toBeNull();
});
