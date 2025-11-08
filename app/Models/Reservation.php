<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'arrival_date',
        'departure_date',
        'total_price',
        'reservation_status',
        'user_id',
        'room_id',
    ];

    protected $casts = [
        'arrival_date' => 'date',
        'departure_date' => 'date',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function calculateTotalPrice()
    {
        $days = abs($this->arrival_date->diffInDays($this->departure_date));
        return $days * $this->room->price_per_night;
    }
}
