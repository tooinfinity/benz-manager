import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/cmps/contracts';
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

export default function Index({
    direction,
    cmp,
    contracts,
}: {
    direction: Direction;
    cmp: Cmp;
    contracts: Contract[];
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
        { title: cmp.name, href: `/directions/${direction.id}/cmps/${cmp.id}` },
        {
            title: 'Contracts',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`${cmp.name} — Contracts`} />
            <div className="flex items-center justify-between">
                <Heading
                    title={`Contracts — ${cmp.name}`}
                    description="Manage contracts within this cmp"
                />
                <Button asChild>
                    <Link href={create([direction.id, cmp.id])}>
                        Create contract
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
                            <th className="px-4 py-2 text-left font-medium">
                                Intitule
                            </th>
                            <th className="px-4 py-2 text-left font-medium">
                                Nature
                            </th>
                            <th className="px-4 py-2 text-left font-medium">
                                Tech
                            </th>
                            <th className="px-4 py-2 text-right font-medium">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {contracts.length === 0 && (
                            <tr>
                                <td
                                    colSpan={5}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No contracts yet.
                                </td>
                            </tr>
                        )}
                        {contracts.map((contract) => (
                            <tr
                                key={contract.id}
                                className="border-b last:border-0"
                            >
                                <td className="px-4 py-2">{contract.numero}</td>
                                <td className="px-4 py-2">
                                    {contract.intitule}
                                </td>
                                <td className="px-4 py-2">
                                    {contract.nature_travaux}
                                </td>
                                <td className="px-4 py-2">
                                    {contract.technologie}
                                </td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link
                                            href={`/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}`}
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
