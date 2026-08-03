<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Zone;
use Illuminate\Support\Facades\DB;

final readonly class CreateZone
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): Zone
    {
        return DB::transaction(fn (): Zone => Zone::query()->create($attributes));
    }
}
