import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/zones/sros';
import type { BreadcrumbItem } from '@/types';

type Zone = { id: string; code: string };
type Sro = { id: string; code: string };

export default function Show({ zone, sro }: { zone: Zone; sro: Sro }) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Zones', href: '/zones' },
        { title: zone.code, href: `/zones/${zone.id}` },
        { title: 'Sros', href: `/zones/${zone.id}/sros` },
        { title: sro.code, href: `/zones/${zone.id}/sros/${sro.id}` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={sro.code} />
            <div className="flex items-center justify-between">
                <Heading title={sro.code} description="Sro details" />
                <Button asChild variant="outline">
                    <Link href={edit([zone.id, sro.id])}>Edit</Link>
                </Button>
            </div>
        </AppLayout>
    );
}
