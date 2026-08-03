<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ServiceOrderSignatory;
use Illuminate\Support\Facades\DB;

final readonly class CreateServiceOrderSignatory
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): ServiceOrderSignatory
    {
        return DB::transaction(fn (): ServiceOrderSignatory => ServiceOrderSignatory::query()->create($attributes));
    }
}
