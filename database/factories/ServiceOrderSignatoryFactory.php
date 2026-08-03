<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\SignatoryRole;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderSignatory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceOrderSignatory>
 */
final class ServiceOrderSignatoryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_order_id' => ServiceOrder::factory(),
            'role' => fake()->randomElement(SignatoryRole::cases()),
            'name' => fake()->name(),
        ];
    }

    public function directionOperational(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => SignatoryRole::Direction_operational,
            'name' => fake()->name(),
        ]);
    }

    public function cil(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => SignatoryRole::Cil,
            'name' => fake()->name(),
        ]);
    }

    public function cmp(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => SignatoryRole::Cmp,
            'name' => fake()->name(),
        ]);
    }

    public function surveillantChantier(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => SignatoryRole::Surveillant_chantier,
            'name' => fake()->name(),
        ]);
    }

    public function prestataire(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => SignatoryRole::Prestataire,
            'name' => fake()->company(),
        ]);
    }

    public function magasin(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => SignatoryRole::Magasin,
            'name' => fake()->name(),
        ]);
    }

    public function unnamed(): self
    {
        return $this->state(fn (array $attributes): array => [
            'name' => null,
        ]);
    }
}
