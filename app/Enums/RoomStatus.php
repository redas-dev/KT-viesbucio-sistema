<?php

namespace App\Enums;

enum RoomStatus: string
{
    case Available = 'laisvas';
    case Occupied = 'užimtas';
}
