<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\ServiceOrder;
use App\Models\Zone;
use Illuminate\Database\Seeder;

final class ServiceOrderSeeder extends Seeder
{
    public function run(): void
    {
        Contract::query()->each(function (Contract $contract): void {
            ServiceOrder::factory()
                ->count(2)
                ->for($contract)
                ->for(Zone::query()->inRandomOrder()->firstOrFail())
                ->create();
        });
    }
}
