<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateServiceOrder;
use App\Actions\DeleteServiceOrder;
use App\Actions\UpdateServiceOrder;
use App\Http\Requests\CreateServiceOrderRequest;
use App\Http\Requests\DeleteServiceOrderRequest;
use App\Http\Requests\UpdateServiceOrderRequest;
use App\Models\Cmp;
use App\Models\Contract;
use App\Models\Direction;
use App\Models\ServiceOrder;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final readonly class ServiceOrderController
{
    public function index(Direction $direction, Cmp $cmp, Contract $contract): Response
    {
        return Inertia::render('service-orders/index', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'serviceOrders' => $contract->serviceOrders()->latest()->get(),
        ]);
    }

    public function create(Direction $direction, Cmp $cmp, Contract $contract): Response
    {
        return Inertia::render('service-orders/create', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'zones' => Zone::query()->latest()->get(),
        ]);
    }

    public function store(CreateServiceOrderRequest $request, Direction $direction, Cmp $cmp, Contract $contract, CreateServiceOrder $action): RedirectResponse
    {
        $serviceOrder = $action->handle($request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Service order created.'),
        ]);

        return to_route('contracts.service-orders.show', [$direction, $cmp, $contract, $serviceOrder]);
    }

    public function show(Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder): Response
    {
        return Inertia::render('service-orders/show', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'serviceOrder' => $serviceOrder,
        ]);
    }

    public function edit(Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder): Response
    {
        return Inertia::render('service-orders/edit', [
            'direction' => $direction,
            'cmp' => $cmp,
            'contract' => $contract,
            'serviceOrder' => $serviceOrder,
            'zones' => Zone::query()->latest()->get(),
        ]);
    }

    public function update(UpdateServiceOrderRequest $request, Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder, UpdateServiceOrder $action): RedirectResponse
    {
        $action->handle($serviceOrder, $request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Service order updated.'),
        ]);

        return to_route('contracts.service-orders.show', [$direction, $cmp, $contract, $serviceOrder]);
    }

    public function destroy(DeleteServiceOrderRequest $request, Direction $direction, Cmp $cmp, Contract $contract, ServiceOrder $serviceOrder, DeleteServiceOrder $action): RedirectResponse
    {
        $action->handle($serviceOrder);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Service order deleted.'),
        ]);

        return to_route('contracts.service-orders.index', [$direction, $cmp, $contract]);
    }
}
