<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cmp;
use App\Models\Direction;
use Illuminate\Database\Seeder;

final class CmpSeeder extends Seeder
{
    public function run(): void
    {
        Direction::query()->each(function (Direction $direction): void {
            for ($i = 1; $i <= 2; $i++) {
                Cmp::query()->firstOrCreate([
                    'direction_id' => $direction->id,
                    'name' => sprintf('%s-CMP-%d', $direction->name, $i),
                ]);
            }
        });
    }
}
