import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/directions';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Directions', href: '/directions' },
];

export default function Index({ directions }: { directions: Direction[] }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Directions" />
            <div className="flex items-center justify-between">
                <Heading title="Directions" description="Manage directions" />
                <Button asChild>
                    <Link href={create()}>Create direction</Link>
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
                        {directions.length === 0 && (
                            <tr>
                                <td
                                    colSpan={2}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No directions yet.
                                </td>
                            </tr>
                        )}
                        {directions.map((direction) => (
                            <tr
                                key={direction.id}
                                className="border-b last:border-0"
                            >
                                <td className="px-4 py-2">{direction.name}</td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link
                                            href={`/directions/${direction.id}`}
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
