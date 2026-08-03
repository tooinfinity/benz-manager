<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\NatureTravaux;
use App\Enums\Technologie;
use App\Models\Cmp;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contract>
 */
final class ContractFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cmp_id' => Cmp::factory(),
            'numero' => sprintf('%d/SDFS/DAL/SA/%d', fake()->unique()->numberBetween(100, 999), now()->year),
            'intitule' => fake()->sentence(4),
            'nature_travaux' => fake()->randomElement(NatureTravaux::cases()),
            'technologie' => fake()->randomElement(Technologie::cases()),
        ];
    }
}
