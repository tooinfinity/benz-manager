<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ServiceOrder;
use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sro>
 */
final class SroFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'zone_id' => Zone::factory(),
            'service_order_id' => ServiceOrder::factory(),
            'code' => sprintf('C%d-%03d-%02d-%02d', fake()->unique()->numberBetween(100, 999), fake()->numberBetween(1, 999), fake()->numberBetween(1, 99), fake()->numberBetween(1, 99)),
        ];
    }

    public function unassigned(): self
    {
        return $this->state(fn (array $attributes): array => [
            'service_order_id' => null,
        ]);
    }
}
