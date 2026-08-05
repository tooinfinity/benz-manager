import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/service-orders/signatories';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };
type Contract = { id: string; numero: string };
type ServiceOrder = { id: string; numero: string };
type Signatory = { id: string; role: string; name?: string | null };

export default function Show({
    direction,
    cmp,
    contract,
    serviceOrder,
    signatory,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
    serviceOrder: ServiceOrder;
    signatory: Signatory;
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
            title: signatory.role,
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/${serviceOrder.id}/signatories/${signatory.id}`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={signatory.role} />
            <div className="flex items-center justify-between">
                <Heading
                    title={signatory.role}
                    description="Signatory details"
                />
                <Button asChild variant="outline">
                    <Link
                        href={edit([
                            direction.id,
                            cmp.id,
                            contract.id,
                            serviceOrder.id,
                            signatory.id,
                        ])}
                    >
                        Edit
                    </Link>
                </Button>
            </div>

            <dl className="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt className="text-sm text-muted-foreground">Name</dt>
                    <dd>{signatory.name ?? '—'}</dd>
                </div>
            </dl>
        </AppLayout>
    );
}
