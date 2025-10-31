<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'employer_id',
        'name',
        'logo_url',
        'description',
        'address'
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function teamMembers(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }
}
