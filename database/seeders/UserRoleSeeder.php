<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $users = [
            [
                'name' => 'Super Admin DigiTalent',
                'email' => 'superadmin@mail.com',
                'password' => 'admin!',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Content Admin DigiTalent',
                'email' => 'admin@mail.com',
                'password' => 'admin',
                'role' => 'Admin',
            ],
            [
                'name' => 'Editor DigiTalent',
                'email' => 'editor@mail.com',
                'password' => '88888888!',
                'role' => 'editor',
            ],
            [
                'name' => 'Viewer DigiTalent',
                'email' => 'viewer@mail.com',
                'password' => '88888888!',
                'role' => 'viewer',
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

            $user->syncRoles([$entry['role']]);
        }

        User::query()
            ->where('email', 'paneluser@mail.com')
            ->delete();

        User::query()
            ->where('email', 'contentadmin@mail.com')
            ->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
