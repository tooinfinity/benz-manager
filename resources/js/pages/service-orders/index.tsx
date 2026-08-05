import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/contracts/service-orders';
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

export default function Index({
    direction,
    cmp,
    contract,
    serviceOrders,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
    serviceOrders: ServiceOrder[];
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
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`${contract.numero} — Service Orders`} />
            <div className="flex items-center justify-between">
                <Heading
                    title={`Service Orders — ${contract.numero}`}
                    description="Manage service orders within this contract"
                />
                <Button asChild>
                    <Link href={create([direction.id, cmp.id, contract.id])}>
                        Create service order
                    </Link>
                </Button>
            </div>

            <div className="mt-6 overflow-hidden rounded-lg border">
                <table className="w-full text-sm">
                    <thead className="border-b bg-muted/50">
                        <tr>
                            <th className="px-4 py-2 text-left font-medium">
                                Numero
                            </th>
                            <th className="px-4 py-2 text-right font-medium">
                                Logements
                            </th>
                            <th className="px-4 py-2 text-right font-medium">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {serviceOrders.length === 0 && (
                            <tr>
                                <td
                                    colSpan={3}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No service orders yet.
                                </td>
                            </tr>
                        )}
                        {serviceOrders.map((serviceOrder) => (
                            <tr
                                key={serviceOrder.id}
                                className="border-b last:border-0"
                            >
                                <td className="px-4 py-2">
                                    {serviceOrder.numero}
                                </td>
                                <td className="px-4 py-2 text-right">
                                    {serviceOrder.nombre_logements ?? '—'}
                                </td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link
                                            href={`/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/service-orders/${serviceOrder.id}`}
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
