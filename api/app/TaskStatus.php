<?php

namespace App;

enum TaskStatus: string 
{
    case ACTIVE = 'active';
    case COMPLETE = 'complete';
    case INACTIVE = 'inactive';
    case IN_PROGRESS = 'in_progress';
}