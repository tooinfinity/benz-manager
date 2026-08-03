<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ServiceOrder;
use Illuminate\Database\Seeder;

final class ServiceOrderSignatorySeeder extends Seeder
{
    /**
     * @var list<array{role: string, name: string}>
     */
    private const array SIGNATORIES = [
        ['role' => 'DO', 'name' => 'Karim Boudjellal'],
        ['role' => 'CIL', 'name' => 'Yasmine Belkacem'],
        ['role' => 'CMP', 'name' => 'Nadir Hamidi'],
        ['role' => 'Surveillant_chantier', 'name' => 'Sofiane Merah'],
        ['role' => 'Prestataire', 'name' => 'Telecom Plus SARL'],
        ['role' => 'Magasin', 'name' => 'Reda Cherif'],
    ];

    public function run(): void
    {
        ServiceOrder::query()->each(function (ServiceOrder $serviceOrder): void {
            $serviceOrder->signatories()->createMany(self::SIGNATORIES);
        });
    }
}
