<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contract;
use App\Models\ServiceOrder;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceOrder>
 */
final class ServiceOrderFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $openedAt = fake()->dateTimeBetween('-2 years', 'now');

        return [
            'contract_id' => Contract::factory(),
            'zone_id' => Zone::factory(),
            'numero' => sprintf('AT/DOT/N°%d/SDTO/DRA/RU-ODN/%d', fake()->unique()->numberBetween(100, 999), now()->year),
            'nombre_logements' => fake()->numberBetween(1, 500),
            'date_ouverture' => $openedAt,
            'date_reception' => fake()->optional(0.7)->dateTimeBetween($openedAt, 'now'),
            'date_reversement' => null,
        ];
    }

    public function opened(): self
    {
        return $this->state(fn (array $attributes): array => [
            'date_ouverture' => now(),
            'date_reception' => null,
            'date_reversement' => null,
        ]);
    }

    public function received(): self
    {
        return $this->state(fn (array $attributes): array => [
            'date_reception' => now(),
            'date_reversement' => null,
        ]);
    }

    public function reversed(): self
    {
        return $this->state(function (array $attributes): array {
            $openedAt = $attributes['date_ouverture'] ?? now();

            return [
                'date_reception' => fake()->dateTimeBetween($openedAt, 'now'),
                'date_reversement' => now(),
            ];
        });
    }
}
