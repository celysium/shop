<?php

namespace App\Enumerations\Delivery;

enum Status: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
}
