<?php

namespace App;

enum JobType: string
{
    case NotSet = 'not-set';
    case OnSite = 'on-site';
    case Hybrid = 'hybrid';
    case Remote = 'remote';
}
