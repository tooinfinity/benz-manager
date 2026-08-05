<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * @var list<array{name: string, email: string}>
     */
    private const array USERS = [
        ['name' => 'Admin User', 'email' => 'admin@example.com'],
        ['name' => 'Test User', 'email' => 'test@example.com'],
    ];

    public function run(): void
    {
        foreach (self::USERS as $user) {
            User::query()->firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => 'password',
                    'email_verified_at' => now(),
                ],
            );
        }
    }
}
