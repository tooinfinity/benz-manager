<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateCmp;
use App\Actions\DeleteCmp;
use App\Actions\UpdateCmp;
use App\Http\Requests\CreateCmpRequest;
use App\Http\Requests\DeleteCmpRequest;
use App\Http\Requests\UpdateCmpRequest;
use App\Models\Cmp;
use App\Models\Direction;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class CmpController
{
    public function index(Direction $direction): Response
    {
        return Inertia::render('cmps/index', [
            'direction' => $direction,
            'cmps' => $direction->cmps()->latest()->get(),
        ]);
    }

    public function create(Direction $direction): Response
    {
        return Inertia::render('cmps/create', [
            'direction' => $direction,
        ]);
    }

    public function store(CreateCmpRequest $request, Direction $direction, CreateCmp $action): RedirectResponse
    {
        $cmp = $action->handle([
            ...$request->validated(),
            'direction_id' => $direction->id,
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Cmp created.'),
        ]);

        return to_route('directions.cmps.show', [$direction, $cmp]);
    }

    public function show(Direction $direction, Cmp $cmp): Response
    {
        return Inertia::render('cmps/show', [
            'direction' => $direction,
            'cmp' => $cmp,
        ]);
    }

    public function edit(Direction $direction, Cmp $cmp): Response
    {
        return Inertia::render('cmps/edit', [
            'direction' => $direction,
            'cmp' => $cmp,
        ]);
    }

    public function update(UpdateCmpRequest $request, Direction $direction, Cmp $cmp, UpdateCmp $action): RedirectResponse
    {
        $action->handle($cmp, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Cmp updated.'),
        ]);

        return to_route('directions.cmps.show', [$direction, $cmp]);
    }

    public function destroy(DeleteCmpRequest $request, Direction $direction, Cmp $cmp, DeleteCmp $action): RedirectResponse
    {
        $action->handle($cmp);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Cmp deleted.'),
        ]);

        return to_route('directions.cmps.index', [$direction]);
    }
}
