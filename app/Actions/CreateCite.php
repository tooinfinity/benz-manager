<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cite;
use Illuminate\Support\Facades\DB;

final readonly class CreateCite
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): Cite
    {
        return DB::transaction(fn (): Cite => Cite::query()->create($attributes));
    }
}
