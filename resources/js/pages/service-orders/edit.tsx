import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { update } from '@/routes/contracts/service-orders';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };
type Contract = { id: string; numero: string };
type ServiceOrder = {
    id: string;
    numero: string;
    nombre_logements?: number | null;
    date_ouverture?: string | null;
    date_reception?: string | null;
    date_reversement?: string | null;
};
type Zone = { id: string; code: string };

export default function Edit({
    direction,
    cmp,
    contract,
    serviceOrder,
    zones,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
    serviceOrder: ServiceOrder;
    zones: Zone[];
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
        { title: cmp.name, href: `/directions/${direction.id}/cmps/${cmp.id}` },
        {
            title: 'Contracts',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts`,
        },
        {
            title: contract.numero,
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}`,
        },
        {
            title: serviceOrder.numero,
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/${serviceOrder.id}`,
        },
        {
            title: 'Edit',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/${serviceOrder.id}/edit`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit ${serviceOrder.numero}`} />
            <Heading
                title={`Edit ${serviceOrder.numero}`}
                description="Update service order details"
            />

            <Form
                {...update.form([
                    direction.id,
                    cmp.id,
                    contract.id,
                    serviceOrder.id,
                ])}
                className="mt-6 max-w-xl space-y-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="numero">Numero</Label>
                            <Input
                                id="numero"
                                name="numero"
                                required
                                defaultValue={serviceOrder.numero}
                            />
                            <InputError message={errors.numero} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="zone_id">Zone</Label>
                            <select
                                id="zone_id"
                                name="zone_id"
                                required
                                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
                                {zones.map((zone) => (
                                    <option key={zone.id} value={zone.id}>
                                        {zone.code}
                                    </option>
                                ))}
                            </select>
                            <InputError message={errors.zone_id} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="nombre_logements">
                                Nombre Logements
                            </Label>
                            <Input
                                id="nombre_logements"
                                name="nombre_logements"
                                type="number"
                                min={0}
                                defaultValue={
                                    serviceOrder.nombre_logements ?? ''
                                }
                            />
                            <InputError message={errors.nombre_logements} />
                        </div>

                        <div className="grid gap-2 sm:grid-cols-3">
                            <div className="grid gap-2">
                                <Label htmlFor="date_ouverture">
                                    Date Ouverture
                                </Label>
                                <Input
                                    id="date_ouverture"
                                    name="date_ouverture"
                                    type="date"
                                    defaultValue={
                                        serviceOrder.date_ouverture ?? ''
                                    }
                                />
                                <InputError message={errors.date_ouverture} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="date_reception">
                                    Date Reception
                                </Label>
                                <Input
                                    id="date_reception"
                                    name="date_reception"
                                    type="date"
                                    defaultValue={
                                        serviceOrder.date_reception ?? ''
                                    }
                                />
                                <InputError message={errors.date_reception} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="date_reversement">
                                    Date Reversement
                                </Label>
                                <Input
                                    id="date_reversement"
                                    name="date_reversement"
                                    type="date"
                                    defaultValue={
                                        serviceOrder.date_reversement ?? ''
                                    }
                                />
                                <InputError message={errors.date_reversement} />
                            </div>
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
