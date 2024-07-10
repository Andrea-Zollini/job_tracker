<?php

namespace App;

enum ApplicationStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
    case InitialInterview = 'initial-interview';
    case TechnicalInterview = 'technical-interview';
}
