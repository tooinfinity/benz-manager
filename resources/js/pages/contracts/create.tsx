import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { store } from '@/routes/cmps/contracts';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };

export default function Create({
    direction,
    cmp,
    natureTravauxValues,
    technologieValues,
}: {
    direction: Direction;
    cmp: Cmp;
    natureTravauxValues: string[];
    technologieValues: string[];
}) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Directions', href: '/directions' },
        { title: direction.name, href: `/directions/${direction.id}` },
        { title: cmp.name, href: `/directions/${direction.id}/cmps/${cmp.id}` },
        {
            title: 'Contracts',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts`,
        },
        {
            title: 'Create',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/create`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create contract" />
            <Heading title="Create contract" description="Add a new contract" />

            <Form
                {...store.form([direction.id, cmp.id])}
                className="mt-6 max-w-xl space-y-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="numero">Numero</Label>
                            <Input
                                id="numero"
                                name="numero"
                                required
                                autoFocus
                            />
                            <InputError message={errors.numero} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="intitule">Intitule</Label>
                            <Input id="intitule" name="intitule" required />
                            <InputError message={errors.intitule} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="nature_travaux">
                                Nature Travaux
                            </Label>
                            <select
                                id="nature_travaux"
                                name="nature_travaux"
                                required
                                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
                                <option value="">Select…</option>
                                {natureTravauxValues.map((value) => (
                                    <option key={value} value={value}>
                                        {value}
                                    </option>
                                ))}
                            </select>
                            <InputError message={errors.nature_travaux} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="technologie">Technologie</Label>
                            <select
                                id="technologie"
                                name="technologie"
                                required
                                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
                                <option value="">Select…</option>
                                {technologieValues.map((value) => (
                                    <option key={value} value={value}>
                                        {value}
                                    </option>
                                ))}
                            </select>
                            <InputError message={errors.technologie} />
                        </div>

                        <Button disabled={processing}>Save</Button>
                    </>
                )}
            </Form>
        </AppLayout>
    );
}
