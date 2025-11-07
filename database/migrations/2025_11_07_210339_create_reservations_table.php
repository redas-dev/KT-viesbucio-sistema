<?php

use App\Enums\ReservationStatus;
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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->double('total_price', 8, 2);
            $table->enum('reservation_status', array_column(ReservationStatus::cases(), 'value'))->default(ReservationStatus::Active->value);
            $table->foreignId('fk_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('fk_room_id')->constrained('rooms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
