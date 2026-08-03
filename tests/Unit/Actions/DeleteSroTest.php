<?php

declare(strict_types=1);

use App\Actions\DeleteSro;
use App\Models\Sro;

it('may delete an sro', function (): void {
    $sro = Sro::factory()->create();

    $action = resolve(DeleteSro::class);

    $action->handle($sro);

    expect($sro->exists)->toBeFalse();
});
