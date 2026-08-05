import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/cmps/contracts';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };
type Contract = {
    id: string;
    numero: string;
    intitule: string;
    nature_travaux: string;
    technologie: string;
};

export default function Show({
    direction,
    cmp,
    contract,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
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
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={contract.numero} />
            <div className="flex items-center justify-between">
                <Heading
                    title={contract.numero}
                    description={contract.intitule}
                />
                <Button asChild variant="outline">
                    <Link href={edit([direction.id, cmp.id, contract.id])}>
                        Edit
                    </Link>
                </Button>
            </div>

            <dl className="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt className="text-sm text-muted-foreground">
                        Nature Travaux
                    </dt>
                    <dd>{contract.nature_travaux}</dd>
                </div>
                <div>
                    <dt className="text-sm text-muted-foreground">
                        Technologie
                    </dt>
                    <dd>{contract.technologie}</dd>
                </div>
            </dl>
        </AppLayout>
    );
}
