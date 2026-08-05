import { Form, Head } from '@inertiajs/react';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { update } from '@/routes/cmps/contracts';
import type { BreadcrumbItem } from '@/types';

type Direction = { id: string; name: string };
type Cmp = { id: string; name: string };
type Contract = {
    id: string;
    numero: string;
    intitule: string;
    nature_travaux: string;
    technologie: string;
};

export default function Edit({
    direction,
    cmp,
    contract,
    natureTravauxValues,
    technologieValues,
}: {
    direction: Direction;
    cmp: Cmp;
    contract: Contract;
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
            title: contract.numero,
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}`,
        },
        {
            title: 'Edit',
            href: `/directions/${direction.id}/cmps/${cmp.id}/contracts/${contract.id}/edit`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit ${contract.numero}`} />
            <Heading
                title={`Edit ${contract.numero}`}
                description="Update contract details"
            />

            <Form
                {...update.form([direction.id, cmp.id, contract.id])}
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
                                defaultValue={contract.numero}
                            />
                            <InputError message={errors.numero} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="intitule">Intitule</Label>
                            <Input
                                id="intitule"
                                name="intitule"
                                required
                                defaultValue={contract.intitule}
                            />
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
                                defaultValue={contract.nature_travaux}
                                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
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
                                defaultValue={contract.technologie}
                                className="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs"
                            >
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
