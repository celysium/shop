<?php

namespace App\Modules\Core\Enumerations\Delivery;

enum Status: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
}
