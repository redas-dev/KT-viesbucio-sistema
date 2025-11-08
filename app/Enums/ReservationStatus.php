<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Active = 'aktyvi';
    case Cancelled = 'atšaukta';
    case Completed = 'baigta';
}
