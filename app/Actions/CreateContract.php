<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Contract;
use Illuminate\Support\Facades\DB;

final readonly class CreateContract
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function handle(array $attributes): Contract
    {
        return DB::transaction(fn (): Contract => Contract::query()->create($attributes));
    }
}
