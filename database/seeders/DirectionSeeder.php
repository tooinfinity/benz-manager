<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Seeder;

final class DirectionSeeder extends Seeder
{
    /**
     * @var list<string>
     */
    private const array NAMES = [
        'CONSTANTINE',
        'ALGIERS',
        'ORAN',
    ];

    public function run(): void
    {
        foreach (self::NAMES as $name) {
            Direction::query()->firstOrCreate(['name' => $name]);
        }
    }
}
