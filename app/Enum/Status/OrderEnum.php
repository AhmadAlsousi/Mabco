<?php

namespace App\Enum\Status;

enum OrderEnum:string
{
    case PENDING="Pending";
    case Completed='Completed';
    case Canceled='Canceled';

}
