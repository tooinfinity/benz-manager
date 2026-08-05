<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateCite;
use App\Actions\DeleteCite;
use App\Actions\UpdateCite;
use App\Http\Requests\CreateCiteRequest;
use App\Http\Requests\DeleteCiteRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Models\Cite;
use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class CiteController
{
    public function index(Zone $zone, Sro $sro): Response
    {
        return Inertia::render('cites/index', [
            'zone' => $zone,
            'sro' => $sro,
            'cites' => $sro->cites()->latest()->get(),
        ]);
    }

    public function create(Zone $zone, Sro $sro): Response
    {
        return Inertia::render('cites/create', [
            'zone' => $zone,
            'sro' => $sro,
        ]);
    }

    public function store(CreateCiteRequest $request, Zone $zone, Sro $sro, CreateCite $action): RedirectResponse
    {
        $cite = $action->handle([
            ...$request->validated(),
            'zone_id' => $zone->id,
            'sro_id' => $sro->id,
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Cite created.'),
        ]);

        return to_route('sros.cites.show', [$zone, $sro, $cite]);
    }

    public function show(Zone $zone, Sro $sro, Cite $cite): Response
    {
        return Inertia::render('cites/show', [
            'zone' => $zone,
            'sro' => $sro,
            'cite' => $cite,
        ]);
    }

    public function edit(Zone $zone, Sro $sro, Cite $cite): Response
    {
        return Inertia::render('cites/edit', [
            'zone' => $zone,
            'sro' => $sro,
            'cite' => $cite,
        ]);
    }

    public function update(UpdateCiteRequest $request, Zone $zone, Sro $sro, Cite $cite, UpdateCite $action): RedirectResponse
    {
        $action->handle($cite, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Cite updated.'),
        ]);

        return to_route('sros.cites.show', [$zone, $sro, $cite]);
    }

    public function destroy(DeleteCiteRequest $request, Zone $zone, Sro $sro, Cite $cite, DeleteCite $action): RedirectResponse
    {
        $action->handle($cite);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Cite deleted.'),
        ]);

        return to_route('sros.cites.index', [$zone, $sro]);
    }
}
