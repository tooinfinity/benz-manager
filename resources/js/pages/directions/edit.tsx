import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { update } from '@/routes/directions';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };

export default function Edit({ direction }: { direction: Direction }) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
        { title: 'Edit', href: `/directions/${direction.id}/edit` },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit ${direction.name}`} />
            <Heading
                title={`Edit ${direction.name}`}
                description="Update direction details"
            />

            <Form
                {...update.form(direction.id)}
                className="mt-6 max-w-xl space-y-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>
                            <Input
                                id="name"
                                name="name"
                                required
                                defaultValue={direction.name}
                            />
                            <InputError message={errors.name} />
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
