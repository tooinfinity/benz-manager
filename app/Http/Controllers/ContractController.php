<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateContract;
use App\Actions\DeleteContract;
use App\Actions\UpdateContract;
use App\Enums\NatureTravaux;
use App\Enums\Technologie;
use App\Http\Requests\CreateContractRequest;
use App\Http\Requests\DeleteContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Cmp;
use App\Models\Contract;
use App\Models\Direction;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class ContractController
{
    public function index(Direction $direction, Cmp $cmp): Response
    {
        return Inertia::render('contracts/index', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contracts' => $cmp->contracts()->latest()->get(),
        ]);
    }

    public function create(Direction $direction, Cmp $cmp): Response
    {
        return Inertia::render('contracts/create', [
            'direction' => $direction,
            'cmp' => $cmp,
            'natureTravauxValues' => array_map(fn (NatureTravaux $case): string => $case->value, NatureTravaux::cases()),
            'technologieValues' => array_map(fn (Technologie $case): string => $case->value, Technologie::cases()),
        ]);
    }

    public function store(CreateContractRequest $request, Direction $direction, Cmp $cmp, CreateContract $action): RedirectResponse
    {
        $contract = $action->handle($request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Contract created.'),
        ]);

        return to_route('cmps.contracts.show', [$direction, $cmp, $contract]);
    }

    public function show(Direction $direction, Cmp $cmp, Contract $contract): Response
    {
        return Inertia::render('contracts/show', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
        ]);
    }

    public function edit(Direction $direction, Cmp $cmp, Contract $contract): Response
    {
        return Inertia::render('contracts/edit', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'natureTravauxValues' => array_map(fn (NatureTravaux $case): string => $case->value, NatureTravaux::cases()),
            'technologieValues' => array_map(fn (Technologie $case): string => $case->value, Technologie::cases()),
        ]);
    }

    public function update(UpdateContractRequest $request, Direction $direction, Cmp $cmp, Contract $contract, UpdateContract $action): RedirectResponse
    {
        $action->handle($contract, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Contract updated.'),
        ]);

        return to_route('cmps.contracts.show', [$direction, $cmp, $contract]);
    }

    public function destroy(DeleteContractRequest $request, Direction $direction, Cmp $cmp, Contract $contract, DeleteContract $action): RedirectResponse
    {
        $action->handle($contract);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Contract deleted.'),
        ]);

        return to_route('cmps.contracts.index', [$direction, $cmp]);
    }
}
