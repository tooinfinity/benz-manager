<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Database\Seeder;

final class SroSeeder extends Seeder
{
    public function run(): void
    {
        Zone::query()->each(function (Zone $zone): void {
            Sro::factory()->count(3)->for($zone)->create();
            Sro::factory()->count(1)->for($zone)->unassigned()->create();
        });
    }
}
