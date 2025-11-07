<?php

use App\Enums\RoomStatus;
use App\Enums\RoomType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->enum('room_type', array_column(RoomType::cases(), 'value'));
            $table->double('price_per_night', 8, 2);
            $table->json('room_features')->nullable();
            $table->string('description')->nullable();
            $table->enum('room_status', array_column(RoomStatus::cases(), 'value'))->default(RoomStatus::Available->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
