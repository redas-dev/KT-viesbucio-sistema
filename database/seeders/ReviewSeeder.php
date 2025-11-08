<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Seed the application with default roles and permissions.
     */
    public function run(): void
    {
        Review::factory(10)->create();
    }
}
