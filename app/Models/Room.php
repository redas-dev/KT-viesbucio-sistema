<?php

namespace App\Models;

use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'room_number',
        'room_type',
        'price_per_night',
        'room_features',
        'description',
        'room_status'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable($arrival_date, $departure_date)
    {
        $conflicts = $this->reservations()
            ->where('reservation_status', ReservationStatus::Active->value)
            ->where(function ($query) use ($arrival_date, $departure_date) {
                $query->whereBetween('arrival_data', [$arrival_date, $departure_date])
                    ->orWhereBetween('departure_data', [$arrival_date, $departure_date])
                    ->orWhere(function ($q) use ($arrival_date, $departure_date) {
                        $q->where('arrival_data', '<=', $arrival_date)
                            ->where('departure_data', '>=', $departure_date);
                    });
            })
            ->count();

        return $conflicts === 0;
    }
}
