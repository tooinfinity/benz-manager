import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/sros/cites';
import type { BreadcrumbItem } from '@/types';

type Zone = { id: string; code: string };
type Sro = { id: string; code: string };
type Cite = { id: string; code: string; name: string };

export default function Index({
    zone,
    sro,
    cites,
}: {
    zone: Zone;
    sro: Sro;
    cites: Cite[];
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Zones', href: '/zones' },
        { title: zone.code, href: `/zones/${zone.id}` },
        { title: 'Sros', href: `/zones/${zone.id}/sros` },
        { title: sro.code, href: `/zones/${zone.id}/sros/${sro.id}` },
        { title: 'Cites', href: `/zones/${zone.id}/sros/${sro.id}/cites` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`${sro.code} — Cites`} />
            <div className="flex items-center justify-between">
                <Heading
                    title={`Cites — ${sro.code}`}
                    description="Manage cites within this sro"
                />
                <Button asChild>
                    <Link href={create([zone.id, sro.id])}>Create cite</Link>
                </Button>
            </div>

            <div className="mt-6 overflow-hidden rounded-lg border">
                <table className="w-full text-sm">
                    <thead className="border-b bg-muted/50">
                        <tr>
                            <th className="px-4 py-2 text-left font-medium">
                                Code
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
                        {cites.length === 0 && (
                            <tr>
                                <td
                                    colSpan={3}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No cites yet.
                                </td>
                            </tr>
                        )}
                        {cites.map((cite) => (
                            <tr
                                key={cite.id}
                                className="border-b last:border-0"
                            >
                                <td className="px-4 py-2">{cite.code}</td>
                                <td className="px-4 py-2">{cite.name}</td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link
                                            href={`/zones/${zone.id}/sros/${sro.id}/cites/${cite.id}`}
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
