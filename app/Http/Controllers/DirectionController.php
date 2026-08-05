<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateDirection;
use App\Actions\DeleteDirection;
use App\Actions\UpdateDirection;
use App\Http\Requests\CreateDirectionRequest;
use App\Http\Requests\DeleteDirectionRequest;
use App\Http\Requests\UpdateDirectionRequest;
use App\Models\Direction;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class DirectionController
{
    public function index(): Response
    {
        return Inertia::render('directions/index', [
            'directions' => Direction::query()->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('directions/create');
    }

    public function store(CreateDirectionRequest $request, CreateDirection $action): RedirectResponse
    {
        $direction = $action->handle($request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Direction created.'),
        ]);

        return to_route('directions.show', $direction);
    }

    public function show(Direction $direction): Response
    {
        return Inertia::render('directions/show', [
            'direction' => $direction,
        ]);
    }

    public function edit(Direction $direction): Response
    {
        return Inertia::render('directions/edit', [
            'direction' => $direction,
        ]);
    }

    public function update(UpdateDirectionRequest $request, Direction $direction, UpdateDirection $action): RedirectResponse
    {
        $action->handle($direction, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Direction updated.'),
        ]);

        return to_route('directions.show', $direction);
    }

    public function destroy(DeleteDirectionRequest $request, Direction $direction, DeleteDirection $action): RedirectResponse
    {
        $action->handle($direction);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Direction deleted.'),
        ]);

        return to_route('directions.index');
    }
}
