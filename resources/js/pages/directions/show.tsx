import { Head, Link } from '@inertiajs/react';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { edit } from '@/routes/directions';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };

export default function Show({ direction }: { direction: Direction }) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={direction.name} />
            <div className="flex items-center justify-between">
                <Heading
                    title={direction.name}
                    description="Direction details"
                />
                <Button asChild variant="outline">
                    <Link href={edit(direction.id)}>Edit</Link>
                </Button>
            </div>
        </AppLayout>
    );
}
