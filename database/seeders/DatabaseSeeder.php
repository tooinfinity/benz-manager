<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DirectionSeeder::class,
            CmpSeeder::class,
            ZoneSeeder::class,
            ContractSeeder::class,
            ServiceOrderSeeder::class,
            SroSeeder::class,
            CiteSeeder::class,
            ServiceOrderSignatorySeeder::class,
        ]);
    }
}
