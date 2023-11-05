<?php

namespace App\Enum;

enum OrderTypes: string
{
    case Pending = 'pending';
    case Canceled = 'canceled';
    case Confirmed = 'confirmed';

}
