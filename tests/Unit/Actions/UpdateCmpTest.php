<?php

declare(strict_types=1);

use App\Actions\UpdateCmp;
use App\Models\Cmp;

it('may update a cmp', function (): void {
    $cmp = Cmp::factory()->create([
        'name' => 'OLD CMP',
    ]);

    $action = resolve(UpdateCmp::class);

    $action->handle($cmp, [
        'name' => 'NEW CMP',
    ]);

    expect($cmp->refresh()->name)->toBe('NEW CMP');
});
