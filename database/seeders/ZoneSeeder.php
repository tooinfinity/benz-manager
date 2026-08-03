<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

final class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 5) as $i) {
            Zone::query()->firstOrCreate([
                'code' => sprintf('Z%03d-%03d', 100 + $i, $i),
            ]);
        }
    }
}
