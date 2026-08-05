import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { create } from '@/routes/zones';
import type { BreadcrumbItem } from '@/types';

type Zone = {
    id: string;
    code: string;
    code_odf?: string | null;
};

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Zones', href: '/zones' }];

export default function Index({ zones }: { zones: Zone[] }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Zones" />
            <div className="flex items-center justify-between">
                <Heading title="Zones" description="Manage zones" />
                <Button asChild>
                    <Link href={create()}>Create zone</Link>
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
                                Code ODF
                            </th>
                            <th className="px-4 py-2 text-right font-medium">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {zones.length === 0 && (
                            <tr>
                                <td
                                    colSpan={3}
                                    className="px-4 py-8 text-center text-muted-foreground"
                                >
                                    No zones yet.
                                </td>
                            </tr>
                        )}
                        {zones.map((zone) => (
                            <tr
                                key={zone.id}
                                className="border-b last:border-0"
                            >
                                <td className="px-4 py-2">{zone.code}</td>
                                <td className="px-4 py-2">
                                    {zone.code_odf ?? '—'}
                                </td>
                                <td className="px-4 py-2 text-right">
                                    <Button variant="ghost" size="sm" asChild>
                                        <Link href={`/zones/${zone.id}`}>
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
