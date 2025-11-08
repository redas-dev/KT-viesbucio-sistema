<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(ReviewSeeder::class);

        $user = User::factory()->create([
            'name' => 'Test user',
            'surname' => 'Example',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // password
        ]);

        $user->assignRole('user');

        $admin = User::factory()->create([
            'name' => 'Admin user',
            'surname' => 'Example',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // password
        ]);

        $admin->assignRole('admin');

        $director = User::factory()->create([
            'name' => 'Director user',
            'surname' => 'Example',
            'email' => 'director@example.com',
            'password' => bcrypt('password'), // password
        ]);

        $director->assignRole('director');
    }
}
