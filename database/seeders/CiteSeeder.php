<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cite;
use App\Models\Zone;
use Illuminate\Database\Seeder;

final class CiteSeeder extends Seeder
{
    public function run(): void
    {
        Zone::query()->each(function (Zone $zone): void {
            $sroIds = $zone->sros()->pluck('id')->all();

            for ($i = 0; $i < 8; $i++) {
                Cite::factory()
                    ->for($zone)
                    ->state(['sro_id' => fake()->randomElement($sroIds)])
                    ->create();
            }

            for ($i = 0; $i < 2; $i++) {
                Cite::factory()
                    ->for($zone)
                    ->withoutSro()
                    ->create();
            }
        });
    }
}
