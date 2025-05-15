<?php

namespace App;

enum TaskStatus: string 
{
    case PENDING = 'pending';
    case COMPLETE = 'complete';
    case IN_PROGRESS = 'in_progress';
}