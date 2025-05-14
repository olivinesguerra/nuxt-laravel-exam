<?php

use App\Http\Util\Enums;

enum TaskStatus: string 
{
    case ACTIVE = 'active';
    case COMPLETE = 'complete';
    case INACTIVE = 'inactive';
    case IN_PROGRESS = 'in_progress';
}