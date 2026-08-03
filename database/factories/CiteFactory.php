<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cite;
use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cite>
 */
final class CiteFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'zone_id' => Zone::factory(),
            'sro_id' => Sro::factory(),
            'code' => sprintf('C%d-%03d-%02d', fake()->unique()->numberBetween(100, 999), fake()->numberBetween(1, 999), fake()->numberBetween(1, 99)),
            'name' => fake()->streetName(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
        ];
    }

    public function withoutSro(): self
    {
        return $this->state(fn (array $attributes): array => [
            'sro_id' => null,
        ]);
    }

    public function withoutCoordinates(): self
    {
        return $this->state(fn (array $attributes): array => [
            'latitude' => null,
            'longitude' => null,
        ]);
    }
}
