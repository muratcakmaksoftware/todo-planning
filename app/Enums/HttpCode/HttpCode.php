<?php

namespace App\Enums\HttpCode;

enum HttpCode: int
{
    case STORE = 600;
    case UPDATE = 601;
    case DESTROY = 602;
    case RESTORE = 603;
}
