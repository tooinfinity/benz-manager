<?php

declare(strict_types=1);

use App\Actions\DeleteCmp;
use App\Models\Cmp;

it('may delete a cmp', function (): void {
    $cmp = Cmp::factory()->create();

    $action = resolve(DeleteCmp::class);

    $action->handle($cmp);

    expect($cmp->exists)->toBeFalse();
});
