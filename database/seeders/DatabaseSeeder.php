<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(CmsContentSeeder::class);
        $this->call(HomeContentSeeder::class);
        $this->call(AboutContentSeeder::class);
        $this->call(ServicesContentSeeder::class);
        $this->call(VisionMissionContentSeeder::class);
        $this->call(PortfolioContentSeeder::class);
        $this->call(TrainingContentSeeder::class);
        $this->call(UserRoleSeeder::class);

        // User::factory(10)->create();

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('88888888!'),
            ]
        );
    }
}
