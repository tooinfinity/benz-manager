<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ServiceOrder;
use Illuminate\Support\Facades\DB;

final readonly class CreateServiceOrder
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): ServiceOrder
    {
        return DB::transaction(fn (): ServiceOrder => ServiceOrder::query()->create($attributes));
    }
}
