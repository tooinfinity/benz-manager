<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Sro;
use Illuminate\Support\Facades\DB;

final readonly class CreateSro
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): Sro
    {
        return DB::transaction(fn (): Sro => Sro::query()->create($attributes));
    }
}
