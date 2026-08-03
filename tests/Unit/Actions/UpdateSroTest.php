<?php

declare(strict_types=1);

use App\Actions\UpdateSro;
use App\Models\Sro;

it('may update an sro', function (): void {
    $sro = Sro::factory()->create([
        'code' => 'C100-001-01-01',
    ]);

    $action = resolve(UpdateSro::class);

    $action->handle($sro, [
        'code' => 'C200-002-02-02',
    ]);

    expect($sro->refresh()->code)->toBe('C200-002-02-02');
});
