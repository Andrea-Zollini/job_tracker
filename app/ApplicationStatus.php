<?php

namespace App;

enum ApplicationStatus: string
{
    case Pending = 'pending'; //yellow
    case Approved = 'approved'; //green
    case Rejected = 'rejected'; //red
    case Cancelled = 'cancelled'; //gray
    case Completed = 'completed'; //blue
    case InitialInterview = 'initial_interview'; //orange
    case TechnicalInterview = 'technical_interview'; //purple
}
