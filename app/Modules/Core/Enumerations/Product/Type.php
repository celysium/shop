<?php

namespace App\Modules\Core\Enumerations\Product;

enum Type: int
{
    case SIMPLE = 0;
    case BUNDELS = 1;
    case CONFIGURABLE = 2;
    case VARIANT = 3;
    case VIRTUAL = 4;
}
