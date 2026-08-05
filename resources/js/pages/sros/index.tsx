import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/zones/sros';
import type { BreadcrumbItem } from '@/types';

type Zone = { id: string; code: string };
type Sro = { id: string; code: string };

export default function Index({ zone, sros }: { zone: Zone; sros: Sro[] }) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Zones', href: '/zones' },
        { title: zone.code, href: `/zones/${zone.id}` },
        { title: 'Sros', href: `/zones/${zone.id}/sros` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`${zone.code} — Sros`} />
            <div className="flex items-center justify-between">
                <Heading
                    title={`Sros — ${zone.code}`}
                    description="Manage sros within this zone"
                />
                <Button asChild>
                    <Link href={create(zone.id)}>Create sro</Link>
                </Button>
            </div>

            <div className="mt-6 overflow-hidden rounded-lg border">
                <table className="w-full text-sm">
                    <thead className="border-b bg-muted/50">
                        <tr>
                            <th className="px-4 py-2 text-left font-medium">
                                Code
                            </th>
                            <th className="px-4 py-2 text-right font-medium">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {sros.length === 0 && (
                            <tr>
                                <td
                                    colSpan={2}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No sros yet.
                                </td>
                            </tr>
                        )}
                        {sros.map((sro) => (
                            <tr key={sro.id} className="border-b last:border-0">
                                <td className="px-4 py-2">{sro.code}</td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link
                                            href={`/zones/${zone.id}/sros/${sro.id}`}
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
