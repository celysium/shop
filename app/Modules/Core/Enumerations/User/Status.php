<?php

namespace App\Modules\Core\Enumerations\User;

enum Status: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
}
