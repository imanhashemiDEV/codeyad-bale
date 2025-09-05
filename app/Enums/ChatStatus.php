<?php

namespace App\Enums;

enum ChatStatus:string
{
    case Pending ='pending';
    case Started = 'started';
    case Closed ='closed';
}
