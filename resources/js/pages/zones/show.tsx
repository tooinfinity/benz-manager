import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/zones';
import type { BreadcrumbItem } from '@/types';

type Zone = {
    id: string;
    code: string;
    code_odf?: string | null;
    olt_latitude?: number | null;
    olt_longitude?: number | null;
};

export default function Show({ zone }: { zone: Zone }) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Zones', href: '/zones' },
        { title: zone.code, href: `/zones/${zone.id}` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={zone.code} />
            <div className="flex items-center justify-between">
                <Heading title={zone.code} description="Zone details" />
                <Button asChild variant="outline">
                    <Link href={edit(zone.id)}>Edit</Link>
                </Button>
            </div>

            <dl className="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt className="text-sm text-muted-foreground">Code ODF</dt>
                    <dd>{zone.code_odf ?? '—'}</dd>
                </div>
                <div>
                    <dt className="text-sm text-muted-foreground">
                        OLT Latitude
                    </dt>
                    <dd>{zone.olt_latitude ?? '—'}</dd>
                </div>
                <div>
                    <dt className="text-sm text-muted-foreground">
                        OLT Longitude
                    </dt>
                    <dd>{zone.olt_longitude ?? '—'}</dd>
                </div>
            </dl>
        </AppLayout>
    );
}
