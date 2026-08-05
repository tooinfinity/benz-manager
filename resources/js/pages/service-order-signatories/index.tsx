import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/service-orders/signatories';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };
type Contract = { id: string; numero: string };
type ServiceOrder = { id: string; numero: string };
type Signatory = { id: string; role: string; name?: string | null };

export default function Index({
    direction,
    cmp,
    contract,
    serviceOrder,
    signatories,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
    serviceOrder: ServiceOrder;
    signatories: Signatory[];
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
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`${serviceOrder.numero} — Signatories`} />
            <div className="flex items-center justify-between">
                <Heading
                    title={`Signatories — ${serviceOrder.numero}`}
                    description="Manage signatories for this service order"
                />
                <Button asChild>
                    <Link
                        href={create([
                            direction.id,
                            cmp.id,
                            contract.id,
                            serviceOrder.id,
                        ])}
                    >
                        Create signatory
                    </Link>
                </Button>
            </div>

            <div className="mt-6 overflow-hidden rounded-lg border">
                <table className="w-full text-sm">
                    <thead className="border-b bg-muted/50">
                        <tr>
                            <th className="px-4 py-2 text-left font-medium">
                                Role
                            </th>
                            <th className="px-4 py-2 text-left font-medium">
                                Name
                            </th>
                            <th className="px-4 py-2 text-right font-medium">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {signatories.length === 0 && (
                            <tr>
                                <td
                                    colSpan={3}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No signatories yet.
                                </td>
                            </tr>
                        )}
                        {signatories.map((signatory) => (
                            <tr
                                key={signatory.id}
                                className="border-b last:border-0"
                            >
                                <td className="px-4 py-2">{signatory.role}</td>
                                <td className="px-4 py-2">
                                    {signatory.name ?? '—'}
                                </td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link
                                            href={`/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/${serviceOrder.id}/signatories/${signatory.id}`}
                                        >
                                            View
                                        </Link>
                                    </Button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </AppLayout>
    );
}
