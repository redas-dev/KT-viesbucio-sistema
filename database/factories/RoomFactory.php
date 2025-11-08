<?php

namespace Database\Factories;

use App\Enums\RoomStatus;
use App\Enums\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_number' => $this->faker->numberBetween(100, 500),
            'room_type' => $this->faker->randomElement(array_column(RoomType::cases(), 'value')),
            'price_per_night' => $this->faker->randomFloat(2, 50, 500),
            'room_features' => json_encode($this->faker->randomElements([
                'WiFi',
                'Air Conditioning',
                'Mini Bar',
                'Ocean View',
                'Balcony',
                'Room Service',
                'Flat Screen TV',
                'Coffee Maker'
            ], $this->faker->numberBetween(2, 5))),
            'description' => $this->faker->paragraph(),
            'room_status' => $this->faker->randomElement(array_column(RoomStatus::cases(), 'value')),
        ];
    }
}
