<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateServiceOrderSignatory;
use App\Actions\DeleteServiceOrderSignatory;
use App\Actions\UpdateServiceOrderSignatory;
use App\Enums\SignatoryRole;
use App\Http\Requests\CreateServiceOrderSignatoryRequest;
use App\Http\Requests\DeleteServiceOrderSignatoryRequest;
use App\Http\Requests\UpdateServiceOrderSignatoryRequest;
use App\Models\Cmp;
use App\Models\Contract;
use App\Models\Direction;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderSignatory;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class ServiceOrderSignatoryController
{
    public function index(Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder): Response
    {
        return Inertia::render('service-order-signatories/index', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'serviceOrder' => $serviceOrder,
            'signatories' => $serviceOrder->signatories()->latest()->get(),
        ]);
    }

    public function create(Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder): Response
    {
        return Inertia::render('service-order-signatories/create', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'serviceOrder' => $serviceOrder,
            'roleValues' => array_map(fn (SignatoryRole $case): string => $case->value, SignatoryRole::cases()),
        ]);
    }

    public function store(CreateServiceOrderSignatoryRequest $request, Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder, CreateServiceOrderSignatory $action): RedirectResponse
    {
        $signatory = $action->handle([
            ...$request->validated(),
            'service_order_id' => $serviceOrder->id,
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Signatory created.'),
        ]);

        return to_route('service-orders.signatories.show', [$direction, $cmp, $contract, $serviceOrder, $signatory]);
    }

    public function show(Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder, ServiceOrderSignatory $signatory): Response
    {
        return Inertia::render('service-order-signatories/show', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'serviceOrder' => $serviceOrder,
            'signatory' => $signatory,
        ]);
    }

    public function edit(Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder, ServiceOrderSignatory $signatory): Response
    {
        return Inertia::render('service-order-signatories/edit', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'serviceOrder' => $serviceOrder,
            'signatory' => $signatory,
            'roleValues' => array_map(fn (SignatoryRole $case): string => $case->value, SignatoryRole::cases()),
        ]);
    }

    public function update(UpdateServiceOrderSignatoryRequest $request, Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder, ServiceOrderSignatory $signatory, UpdateServiceOrderSignatory $action): RedirectResponse
    {
        $action->handle($signatory, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Signatory updated.'),
        ]);

        return to_route('service-orders.signatories.show', [$direction, $cmp, $contract, $serviceOrder, $signatory]);
    }

    public function destroy(DeleteServiceOrderSignatoryRequest $request, Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder, ServiceOrderSignatory $signatory, DeleteServiceOrderSignatory $action): RedirectResponse
    {
        $action->handle($signatory);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Signatory deleted.'),
        ]);

        return to_route('service-orders.signatories.index', [$direction, $cmp, $contract, $serviceOrder]);
    }
}
