import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/directions/cmps';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };

export default function Show({
    direction,
    cmp,
}: {
    direction: Direction;
    cmp: Cmp;
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
        { title: 'Cmps', href: `/directions/${direction.id}/cmps` },
        { title: cmp.name, href: `/directions/${direction.id}/cmps/${cmp.id}` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={cmp.name} />
            <div className="flex items-center justify-between">
                <Heading title={cmp.name} description="Cmp details" />
                <Button asChild variant="outline">
                    <Link href={edit([direction.id, cmp.id])}>Edit</Link>
                </Button>
            </div>
        </AppLayout>
    );
}
