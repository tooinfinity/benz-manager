import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/directions/cmps';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };

export default function Index({
    direction,
    cmps,
}: {
    direction: Direction;
    cmps: Cmp[];
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
        { title: 'Cmps', href: `/directions/${direction.id}/cmps` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`${direction.name} — Cmps`} />
            <div className="flex items-center justify-between">
                <Heading
                    title={`Cmps — ${direction.name}`}
                    description="Manage cmps within this direction"
                />
                <Button asChild>
                    <Link href={create([direction.id])}>Create cmp</Link>
                </Button>
            </div>

            <div className="mt-6 overflow-hidden rounded-lg border">
                <table className="w-full text-sm">
                    <thead className="border-b bg-muted/50">
                        <tr>
                            <th className="px-4 py-2 text-left font-medium">
                                Name
                            </th>
                            <th className="px-4 py-2 text-right font-medium">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {cmps.length === 0 && (
                            <tr>
                                <td
                                    colSpan={2}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No cmps yet.
                                </td>
                            </tr>
                        )}
                        {cmps.map((cmp) => (
                            <tr key={cmp.id} className="border-b last:border-0">
                                <td className="px-4 py-2">{cmp.name}</td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link
                                            href={`/directions/${direction.id}/cmps/${cmp.id}`}
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
