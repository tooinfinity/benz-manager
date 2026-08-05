<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateSro;
use App\Actions\DeleteSro;
use App\Actions\UpdateSro;
use App\Http\Requests\CreateSroRequest;
use App\Http\Requests\DeleteSroRequest;
use App\Http\Requests\UpdateSroRequest;
use App\Models\ServiceOrder;
use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class SroController
{
    public function index(Zone $zone): Response
    {
        return Inertia::render('sros/index', [
            'zone' => $zone,
            'sros' => $zone->sros()->latest()->get(),
        ]);
    }

    public function create(Zone $zone): Response
    {
        return Inertia::render('sros/create', [
            'zone' => $zone,
            'serviceOrders' => ServiceOrder::query()->latest()->get(),
        ]);
    }

    public function store(CreateSroRequest $request, Zone $zone, CreateSro $action): RedirectResponse
    {
        $sro = $action->handle([
            ...$request->validated(),
            'zone_id' => $zone->id,
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Sro created.'),
        ]);

        return to_route('zones.sros.show', [$zone, $sro]);
    }

    public function show(Zone $zone, Sro $sro): Response
    {
        return Inertia::render('sros/show', [
            'zone' => $zone,
            'sro' => $sro,
        ]);
    }

    public function edit(Zone $zone, Sro $sro): Response
    {
        return Inertia::render('sros/edit', [
            'zone' => $zone,
            'sro' => $sro,
            'serviceOrders' => ServiceOrder::query()->latest()->get(),
        ]);
    }

    public function update(UpdateSroRequest $request, Zone $zone, Sro $sro, UpdateSro $action): RedirectResponse
    {
        $action->handle($sro, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Sro updated.'),
        ]);

        return to_route('zones.sros.show', [$zone, $sro]);
    }

    public function destroy(DeleteSroRequest $request, Zone $zone, Sro $sro, DeleteSro $action): RedirectResponse
    {
        $action->handle($sro);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Sro deleted.'),
        ]);

        return to_route('zones.sros.index', [$zone]);
    }
}
