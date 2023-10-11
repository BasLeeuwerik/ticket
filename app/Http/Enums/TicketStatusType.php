<?php

namespace App\Http\Enums;

enum TicketStatusType: string
{
    case OPEN = 'open';
    case COMPLETED = 'completed';
    case CLOSED = 'closed';
}
