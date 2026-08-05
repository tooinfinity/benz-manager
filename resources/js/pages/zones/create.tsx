import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { store } from '@/routes/zones';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Zones', href: '/zones' },
    { title: 'Create', href: '/zones/create' },
];

export default function Create() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create zone" />
            <Heading title="Create zone" description="Add a new zone" />

            <Form {...store.form()} className="mt-6 max-w-xl space-y-6">
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="code">Code</Label>
                            <Input id="code" name="code" required autoFocus />
                            <InputError message={errors.code} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="code_odf">Code ODF</Label>
                            <Input id="code_odf" name="code_odf" />
                            <InputError message={errors.code_odf} />
                        </div>

                        <div className="grid gap-2 sm:grid-cols-2">
                            <div className="grid gap-2">
                                <Label htmlFor="olt_latitude">
                                    OLT Latitude
                                </Label>
                                <Input
                                    id="olt_latitude"
                                    name="olt_latitude"
                                    type="number"
                                    step="0.0000001"
                                />
                                <InputError message={errors.olt_latitude} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="olt_longitude">
                                    OLT Longitude
                                </Label>
                                <Input
                                    id="olt_longitude"
                                    name="olt_longitude"
                                    type="number"
                                    step="0.0000001"
                                />
                                <InputError message={errors.olt_longitude} />
                            </div>
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
