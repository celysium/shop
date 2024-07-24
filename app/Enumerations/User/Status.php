<?php

namespace App\Enumerations\User;

enum Status: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
}
