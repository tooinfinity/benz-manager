import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { update } from '@/routes/sros/cites';
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

export default function Edit({
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
        {
            title: 'Edit',
            href: `/zones/${zone.id}/sros/${sro.id}/cites/${cite.id}/edit`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit ${cite.code}`} />
            <Heading
                title={`Edit ${cite.code}`}
                description="Update cite details"
            />

            <Form
                {...update.form([zone.id, sro.id, cite.id])}
                className="mt-6 max-w-xl space-y-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="code">Code</Label>
                            <Input
                                id="code"
                                name="code"
                                required
                                defaultValue={cite.code}
                            />
                            <InputError message={errors.code} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>
                            <Input
                                id="name"
                                name="name"
                                required
                                defaultValue={cite.name}
                            />
                            <InputError message={errors.name} />
                        </div>

                        <div className="grid gap-2 sm:grid-cols-2">
                            <div className="grid gap-2">
                                <Label htmlFor="latitude">Latitude</Label>
                                <Input
                                    id="latitude"
                                    name="latitude"
                                    type="number"
                                    step="0.0000001"
                                    defaultValue={cite.latitude ?? ''}
                                />
                                <InputError message={errors.latitude} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="longitude">Longitude</Label>
                                <Input
                                    id="longitude"
                                    name="longitude"
                                    type="number"
                                    step="0.0000001"
                                    defaultValue={cite.longitude ?? ''}
                                />
                                <InputError message={errors.longitude} />
                            </div>
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
