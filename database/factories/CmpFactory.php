<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cmp;
use App\Models\Direction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cmp>
 */
final class CmpFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'direction_id' => Direction::factory(),
            'name' => fake()->unique()->city(),
        ];
    }
}
