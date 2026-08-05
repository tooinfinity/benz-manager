import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/sros/cites';
import type { BreadcrumbItem } from '@/types';

type Zone = { id: string; code: string };
type Sro = { id: string; code: string };
type Cite = {
    id: string;
    code: string;
    name: string;
    latitude?: number | null;
    longitude?: number | null;
};

export default function Show({
    zone,
    sro,
    cite,
}: {
    zone: Zone;
    sro: Sro;
    cite: Cite;
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Zones', href: '/zones' },
        { title: zone.code, href: `/zones/${zone.id}` },
        { title: 'Sros', href: `/zones/${zone.id}/sros` },
        { title: sro.code, href: `/zones/${zone.id}/sros/${sro.id}` },
        { title: 'Cites', href: `/zones/${zone.id}/sros/${sro.id}/cites` },
        {
            title: cite.code,
            href: `/zones/${zone.id}/sros/${sro.id}/cites/${cite.id}`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={cite.code} />
            <div className="flex items-center justify-between">
                <Heading title={cite.name} description={cite.code} />
                <Button asChild variant="outline">
                    <Link href={edit([zone.id, sro.id, cite.id])}>Edit</Link>
                </Button>
            </div>

            <dl className="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt className="text-sm text-muted-foreground">Latitude</dt>
                    <dd>{cite.latitude ?? '—'}</dd>
                </div>
                <div>
                    <dt className="text-sm text-muted-foreground">Longitude</dt>
                    <dd>{cite.longitude ?? '—'}</dd>
                </div>
            </dl>
        </AppLayout>
    );
}
