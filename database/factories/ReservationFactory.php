<?php

namespace Database\Factories;

use App\Enums\ReservationStatus;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'arrival_date' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'departure_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'total_price' => $this->faker->randomFloat(2, 100, 1000),
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
        ];
    }
}
