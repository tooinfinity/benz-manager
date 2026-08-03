<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Direction;
use Illuminate\Support\Facades\DB;

final readonly class CreateDirection
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): Direction
    {
        return DB::transaction(fn (): Direction => Direction::query()->create($attributes));
    }
}
