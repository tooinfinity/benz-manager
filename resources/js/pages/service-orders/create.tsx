import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { store } from '@/routes/contracts/service-orders';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };
type Contract = { id: string; numero: string };
type Zone = { id: string; code: string };

export default function Create({
    direction,
    cmp,
    contract,
    zones,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
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
            title: 'Service Orders',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders`,
        },
        {
            title: 'Create',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/create`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create service order" />
            <Heading
                title="Create service order"
                description="Add a new service order"
            />

            <Form
                {...store.form([direction.id, cmp.id, contract.id])}
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
                                autoFocus
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
                                <option value="">Select…</option>
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
