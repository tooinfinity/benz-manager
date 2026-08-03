<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Zone>
 */
final class ZoneFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => sprintf('Z%d-%03d', fake()->unique()->numberBetween(100, 999), fake()->numberBetween(1, 999)),
            'code_odf' => sprintf('ODF-%05d', fake()->unique()->numberBetween(1, 99999)),
            'olt_latitude' => fake()->latitude(),
            'olt_longitude' => fake()->longitude(),
        ];
    }
}
