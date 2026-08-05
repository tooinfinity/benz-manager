import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { store } from '@/routes/service-orders/signatories';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };
type Contract = { id: string; numero: string };
type ServiceOrder = { id: string; numero: string };

export default function Create({
    direction,
    cmp,
    contract,
    serviceOrder,
    roleValues,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
    serviceOrder: ServiceOrder;
    roleValues: string[];
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
            title: 'Signatories',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/${serviceOrder.id}/signatories`,
        },
        {
            title: 'Create',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/${serviceOrder.id}/signatories/create`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create signatory" />
            <Heading
                title="Create signatory"
                description="Add a new signatory"
            />

            <Form
                {...store.form([
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
                            <Label htmlFor="role">Role</Label>
                            <select
                                id="role"
                                name="role"
                                required
                                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
                                <option value="">Select…</option>
                                {roleValues.map((value) => (
                                    <option key={value} value={value}>
                                        {value}
                                    </option>
                                ))}
                            </select>
                            <InputError message={errors.role} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>
                            <Input id="name" name="name" />
                            <InputError message={errors.name} />
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
