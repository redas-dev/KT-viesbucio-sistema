<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Seed the application with default roles and permissions.
     */
    public function run(): void
    {
        Reservation::factory(10)->create();
    }
}
