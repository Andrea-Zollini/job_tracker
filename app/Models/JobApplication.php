<?php

namespace App\Models;

use App\ApplicationStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'job_title',
        'slug',
        'description',
        'company_name',
        'location',
        'job_type',
        'status',
        'metadata',
    ];

    protected $casts = [
        'status' => ApplicationStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
