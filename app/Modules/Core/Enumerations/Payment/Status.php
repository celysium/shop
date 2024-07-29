<?php

namespace App\Modules\Core\Enumerations\Payment;

enum Status: int
{
    case NEW = 0;
    case PENDING = 1;
    case SUCCESS = 2;
    case FAILED = 3;

}
