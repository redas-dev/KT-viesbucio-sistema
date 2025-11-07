<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Active = 'active';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
}
