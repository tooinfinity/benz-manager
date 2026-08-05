<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateZone;
use App\Actions\DeleteZone;
use App\Actions\UpdateZone;
use App\Http\Requests\CreateZoneRequest;
use App\Http\Requests\DeleteZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class ZoneController
{
    public function index(): Response
    {
        return Inertia::render('zones/index', [
            'zones' => Zone::query()->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('zones/create');
    }

    public function store(CreateZoneRequest $request, CreateZone $action): RedirectResponse
    {
        $zone = $action->handle($request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Zone created.'),
        ]);

        return to_route('zones.show', $zone);
    }

    public function show(Zone $zone): Response
    {
        return Inertia::render('zones/show', [
            'zone' => $zone,
        ]);
    }

    public function edit(Zone $zone): Response
    {
        return Inertia::render('zones/edit', [
            'zone' => $zone,
        ]);
    }

    public function update(UpdateZoneRequest $request, Zone $zone, UpdateZone $action): RedirectResponse
    {
        $action->handle($zone, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Zone updated.'),
        ]);

        return to_route('zones.show', $zone);
    }

    public function destroy(DeleteZoneRequest $request, Zone $zone, DeleteZone $action): RedirectResponse
    {
        $action->handle($zone);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Zone deleted.'),
        ]);

        return to_route('zones.index');
    }
}
