<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminContentUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin1',
                'email' => 'admin1@mail.com',
                'password' => 'admin',
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@mail.com',
                'password' => 'admin',
            ],
        ];

        foreach ($users as $entry) {
            $user = User::query()->updateOrCreate(
                ['email' => $entry['email']],
                [
                    'name' => $entry['name'],
                    'password' => Hash::make($entry['password']),
                ]
            );

            $user->syncRoles(['admin_content']);
        }
    }
}
