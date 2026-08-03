<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cmp;
use App\Models\Contract;
use Illuminate\Database\Seeder;

final class ContractSeeder extends Seeder
{
    public function run(): void
    {
        Cmp::query()->each(function (Cmp $cmp): void {
            Contract::factory()
                ->count(2)
                ->for($cmp)
                ->create();
        });
    }
}
