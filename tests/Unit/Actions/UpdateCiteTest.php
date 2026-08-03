<?php

declare(strict_types=1);

use App\Actions\UpdateCite;
use App\Models\Cite;

it('may update a cite', function (): void {
    $cite = Cite::factory()->create([
        'name' => 'OLD NAME',
    ]);

    $action = resolve(UpdateCite::class);

    $action->handle($cite, [
        'name' => 'NEW NAME',
    ]);

    expect($cite->refresh()->name)->toBe('NEW NAME');
});
