import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { store } from '@/routes/directions/cmps';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };

export default function Create({ direction }: { direction: Direction }) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
        { title: 'Cmps', href: `/directions/${direction.id}/cmps` },
        { title: 'Create', href: `/directions/${direction.id}/cmps/create` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create cmp" />
            <Heading
                title="Create cmp"
                description={`Add a cmp to ${direction.name}`}
            />

            <Form
                {...store.form([direction.id])}
                className="mt-6 max-w-xl space-y-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>
                            <Input id="name" name="name" required autoFocus />
                            <InputError message={errors.name} />
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
