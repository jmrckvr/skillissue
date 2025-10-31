<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'location',
        'salary_min',
        'salary_max',
        'type',
        'status',
        'posted_at',
        'expires_at'
    ];

    protected $casts = [
        'posted_at' => 'datetime',
        'expires_at' => 'datetime',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
