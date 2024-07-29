<?php

namespace App\Modules\Core\Enumerations\Order;

enum Status: int
{
    case NEW = 0;
    case PAYMENT = 1;
    case SUCCESS = 2;
    case FAILED = 3;
    case PROCESS = 4;
    case DELIVERED = 5;
}
