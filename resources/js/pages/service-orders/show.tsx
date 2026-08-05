import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/contracts/service-orders';
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

export default function Show({
    direction,
    cmp,
    contract,
    serviceOrder,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
    serviceOrder: ServiceOrder;
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
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={serviceOrder.numero} />
            <div className="flex items-center justify-between">
                <Heading
                    title={serviceOrder.numero}
                    description="Service order details"
                />
                <Button asChild variant="outline">
                    <Link
                        href={edit([
                            direction.id,
                            cmp.id,
                            contract.id,
                            serviceOrder.id,
                        ])}
                    >
                        Edit
                    </Link>
                </Button>
            </div>

            <dl className="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt className="text-sm text-muted-foreground">
                        Nombre Logements
                    </dt>
                    <dd>{serviceOrder.nombre_logements ?? '—'}</dd>
                </div>
                <div>
                    <dt className="text-sm text-muted-foreground">
                        Date Ouverture
                    </dt>
                    <dd>{serviceOrder.date_ouverture ?? '—'}</dd>
                </div>
                <div>
                    <dt className="text-sm text-muted-foreground">
                        Date Reception
                    </dt>
                    <dd>{serviceOrder.date_reception ?? '—'}</dd>
                </div>
                <div>
                    <dt className="text-sm text-muted-foreground">
                        Date Reversement
                    </dt>
                    <dd>{serviceOrder.date_reversement ?? '—'}</dd>
                </div>
            </dl>
        </AppLayout>
    );
}
