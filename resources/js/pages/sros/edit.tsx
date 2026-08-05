import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { update } from '@/routes/zones/sros';
import type { BreadcrumbItem } from '@/types';

type Zone = { id: string; code: string };
type Sro = { id: string; code: string };
type ServiceOrder = { id: string; numero: string };

export default function Edit({
    zone,
    sro,
    serviceOrders,
}: {
    zone: Zone;
    sro: Sro;
    serviceOrders: ServiceOrder[];
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Zones', href: '/zones' },
        { title: zone.code, href: `/zones/${zone.id}` },
        { title: 'Sros', href: `/zones/${zone.id}/sros` },
        { title: sro.code, href: `/zones/${zone.id}/sros/${sro.id}` },
        { title: 'Edit', href: `/zones/${zone.id}/sros/${sro.id}/edit` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit ${sro.code}`} />
            <Heading
                title={`Edit ${sro.code}`}
                description="Update sro details"
            />

            <Form
                {...update.form([zone.id, sro.id])}
                className="mt-6 max-w-xl space-y-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="code">Code</Label>
                            <Input
                                id="code"
                                name="code"
                                required
                                defaultValue={sro.code}
                            />
                            <InputError message={errors.code} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="service_order_id">
                                Service Order
                            </Label>
                            <select
                                id="service_order_id"
                                name="service_order_id"
                                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
                                <option value="">None</option>
                                {serviceOrders.map((serviceOrder) => (
                                    <option
                                        key={serviceOrder.id}
                                        value={serviceOrder.id}
                                    >
                                        {serviceOrder.numero}
                                    </option>
                                ))}
                            </select>
                            <InputError message={errors.service_order_id} />
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
