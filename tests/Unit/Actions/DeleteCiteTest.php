<?php

declare(strict_types=1);

use App\Actions\DeleteCite;
use App\Models\Cite;

it('may delete a cite', function (): void {
    $cite = Cite::factory()->create();

    $action = resolve(DeleteCite::class);

    $action->handle($cite);

    expect($cite->exists)->toBeFalse();
});
