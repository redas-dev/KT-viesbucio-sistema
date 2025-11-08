<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Seed the application with default roles and permissions.
     */
    public function run(): void
    {
        Room::factory(10)->create();
    }
}
