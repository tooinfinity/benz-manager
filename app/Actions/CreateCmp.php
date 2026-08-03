<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cmp;
use Illuminate\Support\Facades\DB;

final readonly class CreateCmp
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): Cmp
    {
        return DB::transaction(fn (): Cmp => Cmp::query()->create($attributes));
    }
}
